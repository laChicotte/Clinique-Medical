<?php

namespace Tests\Unit;

use App\Support\RichText;
use DOMDocument;
use DOMElement;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class RichTextTest extends TestCase
{
    public function test_basic_formatting_and_medical_text_are_preserved(): void
    {
        $html = '<p>Élévation &amp; dose &lt; 5 mg : <strong>matin</strong><br><em>soir</em></p>'
            .'<ul><li>Repos</li><li>Contrôle</li></ul><p>SpO<sub>2</sub></p>';

        $this->assertSame($html, RichText::sanitize($html));
        $this->assertSame('', RichText::sanitize(null));
        $this->assertSame('', RichText::sanitize(''));
    }

    #[DataProvider('unsafeHtml')]
    public function test_untrusted_html_is_rebuilt_without_executable_content(string $html): void
    {
        $clean = RichText::sanitize($html);

        $document = new DOMDocument();
        $document->loadHTML('<meta charset="UTF-8">'.$clean, LIBXML_NOERROR | LIBXML_NOWARNING | LIBXML_NONET);
        $allowed = [
            'html', 'head', 'meta', 'body', 'p', 'div', 'span', 'br', 'strong', 'b',
            'em', 'i', 'u', 's', 'del', 'blockquote', 'pre', 'code', 'ul', 'ol', 'li',
            'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'sub', 'sup', 'hr',
            'table', 'thead', 'tbody', 'tfoot', 'tr', 'th', 'td',
        ];

        foreach ($document->getElementsByTagName('*') as $element) {
            $this->assertInstanceOf(DOMElement::class, $element);
            $this->assertContains($element->tagName, $allowed, $clean);
            if ($element->tagName !== 'meta') {
                $this->assertSame(0, $element->attributes->length, $clean);
            }
        }

        $this->assertSame($clean, RichText::sanitize($clean));
    }

    public static function unsafeHtml(): array
    {
        return [
            'scripts' => ['<p>Texte</p><script>alert(document.cookie)</script>'],
            'event handlers' => ['<p onclick="alert(1)">Texte<img src=x onerror=alert(1)></p>'],
            'javascript links' => ['<a href="javascript:alert(1)">Texte</a>'],
            'encoded URL' => ['<a href="java&#x73;cript:alert(1)">Texte</a>'],
            'styles and clobbering' => ['<div id="location" name="cookie" style="background:url(javascript:alert(1))">Texte</div>'],
            'SVG' => ['<svg onload="alert(1)"><a xlink:href="javascript:alert(1)">Texte</a></svg>'],
            'MathML' => ['<math><mtext><img src=x onerror=alert(1)></mtext></math>'],
            'embedded documents' => ['<iframe srcdoc="<script>alert(1)</script>"></iframe><object data="data:text/html,attack"></object>'],
            'textarea breakout' => ['</textarea><script>alert(1)</script><textarea>Texte'],
            'attribute breakout' => ['"><img src=x onerror=alert(1)><p>Texte</p>'],
            'malformed foreign markup' => ['<math><mtext><table><mglyph><style><!--</style><img title="--><img src=1 onerror=alert(1)>">'],
            'document breakout' => ['</body></html><script>alert(1)</script><p>Texte</p>'],
            'entities stay text' => ['&lt;script&gt;alert(1)&lt;/script&gt;'],
            'comments' => ['<!-- <img src=x onerror=alert(1)> --><p>Texte</p>'],
            'null bytes' => ["<p>Texte\0</p><scr\0ipt>alert(1)</script>"],
        ];
    }
}
