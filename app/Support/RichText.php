<?php

namespace App\Support;

use DOMDocument;
use DOMElement;
use DOMNode;
use DOMText;

class RichText
{
    // Rebuild formatting from literal tag names; never copy input attributes.
    private const TAGS = [
        'p', 'div', 'span', 'br', 'strong', 'b', 'em', 'i', 'u', 's', 'del',
        'blockquote', 'pre', 'code', 'ul', 'ol', 'li',
        'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'sub', 'sup', 'hr',
        'table', 'thead', 'tbody', 'tfoot', 'tr', 'th', 'td',
    ];

    private const DISCARD = [
        'head', 'script', 'style', 'iframe', 'object', 'embed', 'template',
        'svg', 'math', 'noscript', 'noembed', 'noframes', 'textarea',
        'title', 'xmp', 'plaintext',
    ];

    public static function sanitize(?string $html): string
    {
        if ($html === null || $html === '') {
            return '';
        }

        $html = str_replace("\0", '', $html);

        // If DOM is unavailable, fail closed by displaying escaped text.
        if (!class_exists(DOMDocument::class)) {
            return self::escape($html);
        }

        $document = new DOMDocument('1.0', 'UTF-8');
        $loaded = $document->loadHTML(
            '<!DOCTYPE html><html><head><meta charset="UTF-8"></head><body>'.$html.'</body></html>',
            LIBXML_NONET | LIBXML_NOERROR | LIBXML_NOWARNING
        );

        return $loaded ? self::renderChildren($document) : self::escape($html);
    }

    private static function renderChildren(DOMNode $node): string
    {
        $html = '';

        foreach ($node->childNodes as $child) {
            if ($child instanceof DOMText) {
                $html .= self::escape($child->nodeValue);
                continue;
            }

            if (!$child instanceof DOMElement) {
                continue;
            }

            $tag = strtolower($child->tagName);

            if (in_array($tag, self::DISCARD, true)) {
                continue;
            }

            $content = self::renderChildren($child);

            if (!in_array($tag, self::TAGS, true)) {
                $html .= $content;
            } elseif ($tag === 'br' || $tag === 'hr') {
                $html .= '<'.$tag.'>';
            } else {
                $html .= '<'.$tag.'>'.$content.'</'.$tag.'>';
            }
        }

        return $html;
    }

    private static function escape(string $text): string
    {
        return htmlspecialchars($text, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    }
}
