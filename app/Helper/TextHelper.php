<?php

if (!function_exists('cleanMarkdown')) {
    function cleanMarkdown(string $text): string
    {
        // Remove headings (#, ##, ###)
        $text = preg_replace('/^#+\s*/m', '', $text);

        // Remove bold/italic symbols (** or __ or *)
        $text = preg_replace('/(\*\*|__|\*)/', '', $text);

        // Remove arrows or other common markdown symbols
        $text = str_replace(['=>', '`', '---'], '', $text);

        // Remove extra empty lines at start and end
        $text = trim($text);

        return $text;
    }
}

if (!function_exists('renderMarkdown')) {
    function renderMarkdown(string $text): string
    {
        $text = trim($text);
        if ($text === '') {
            return '';
        }

        $config = [
            // Ensure any raw HTML typed into markdown is escaped, not rendered.
            'html_input' => 'escape',
            // Prevent links with unsafe schemes (like javascript:).
            'allow_unsafe_links' => false,
        ];

        $environment = new \League\CommonMark\Environment\Environment($config);
        $environment->addExtension(new \League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension());

        $converter = new \League\CommonMark\MarkdownConverter($environment);

        $html = (string) $converter->convertToHtml($text);

        // Extra safety: validate link and image URL schemes on the final HTML.
        // (commonmark escaping prevents raw HTML execution, but we still filter URLs)
        $dom = new \DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML('<div id="__md_root__">' . $html . '</div>', LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        libxml_clear_errors();

        $root = $dom->getElementById('__md_root__');
        if ($root === null) {
            return $html;
        }

        $allowedSchemes = ['http', 'https', 'mailto', ''];

        foreach ($dom->getElementsByTagName('a') as $a) {
            /** @var \DOMElement $a */
            $href = trim((string) $a->getAttribute('href'));
            if ($href === '') {
                continue;
            }

            $hrefLower = strtolower($href);

            // Disallow "javascript:" explicitly (and any other non-whitelisted schemes).
            if (str_starts_with($hrefLower, 'javascript:')) {
                $a->setAttribute('href', '#');
                continue;
            }

            // If it has a scheme like "foo:bar", only allow whitelisted schemes.
            if (preg_match('/^([a-z][a-z0-9+\-.]*):/i', $href, $m) === 1) {
                $scheme = strtolower($m[1]);
                if (!in_array($scheme, $allowedSchemes, true)) {
                    $a->setAttribute('href', '#');
                }
            }
        }

        foreach ($dom->getElementsByTagName('img') as $img) {
            /** @var \DOMElement $img */
            $src = trim((string) $img->getAttribute('src'));
            if ($src === '') {
                continue;
            }

            $srcLower = strtolower($src);
            if (!(str_starts_with($srcLower, 'http://') || str_starts_with($srcLower, 'https://'))) {
                // Avoid loading images from data: / javascript: / local paths.
                $img->setAttribute('src', '');
            }
        }

        $out = '';
        foreach ($root->childNodes as $child) {
            $out .= $dom->saveHTML($child);
        }

        return $out;
    }
}
