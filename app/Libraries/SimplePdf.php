<?php

namespace App\Libraries;

class SimplePdf
{
    private array $pages = [];
    private array $currentLines = [];
    private int $maxLinesPerPage = 42;
    private int $maxCharactersPerLine = 86;

    public function title(string $text): void
    {
        $this->addLine($text, 16, true);
        $this->addLine(str_repeat('-', 62));
    }

    public function heading(string $text): void
    {
        $this->addBlankLine();
        $this->addLine($text, 13, true);
    }

    public function field(string $label, $value): void
    {
        if (is_array($value)) {
            $this->addLine($label . ':');
            foreach ($value as $key => $item) {
                $this->field('  ' . $this->labelize((string) $key), $item);
            }
            return;
        }

        $text = $label . ': ' . ($value === null || $value === '' ? '-' : (string) $value);
        $this->addWrappedLine($text);
    }

    public function addBlankLine(): void
    {
        $this->addLine('');
    }

    public function output(): string
    {
        $this->flushPage();

        $objects = [];
        $pagesObjectNumber = 2;
        $fontObjectNumber = 3;
        $nextObjectNumber = 4;
        $pageObjectNumbers = [];

        foreach ($this->pages as $pageLines) {
            $contentObjectNumber = $nextObjectNumber++;
            $pageObjectNumber = $nextObjectNumber++;
            $pageObjectNumbers[] = $pageObjectNumber;

            $stream = $this->buildPageStream($pageLines);
            $objects[$contentObjectNumber] = "<< /Length " . strlen($stream) . " >>\nstream\n" . $stream . "\nendstream";
            $objects[$pageObjectNumber] = "<< /Type /Page /Parent {$pagesObjectNumber} 0 R /MediaBox [0 0 612 792] /Resources << /Font << /F1 {$fontObjectNumber} 0 R >> >> /Contents {$contentObjectNumber} 0 R >>";
        }

        $kids = implode(' ', array_map(static fn ($number) => "{$number} 0 R", $pageObjectNumbers));
        $objects[1] = "<< /Type /Catalog /Pages {$pagesObjectNumber} 0 R >>";
        $objects[$pagesObjectNumber] = "<< /Type /Pages /Kids [{$kids}] /Count " . count($pageObjectNumbers) . " >>";
        $objects[$fontObjectNumber] = "<< /Type /Font /Subtype /Type1 /BaseFont /Helvetica >>";

        ksort($objects);

        $pdf = "%PDF-1.4\n";
        $offsets = [0];

        foreach ($objects as $number => $body) {
            $offsets[$number] = strlen($pdf);
            $pdf .= "{$number} 0 obj\n{$body}\nendobj\n";
        }

        $xrefOffset = strlen($pdf);
        $pdf .= "xref\n0 " . (count($objects) + 1) . "\n";
        $pdf .= "0000000000 65535 f \n";

        for ($i = 1; $i <= count($objects); $i++) {
            $pdf .= sprintf("%010d 00000 n \n", $offsets[$i]);
        }

        $pdf .= "trailer\n<< /Size " . (count($objects) + 1) . " /Root 1 0 R >>\n";
        $pdf .= "startxref\n{$xrefOffset}\n%%EOF";

        return $pdf;
    }

    public function labelize(string $key): string
    {
        return ucwords(str_replace('_', ' ', $key));
    }

    private function addWrappedLine(string $text, int $fontSize = 11, bool $bold = false): void
    {
        foreach ($this->wrapText($text) as $line) {
            $this->addLine($line, $fontSize, $bold);
        }
    }

    private function wrapText(string $text): array
    {
        $text = trim((string) preg_replace('/\s+/', ' ', $text));
        if ($text === '') {
            return [''];
        }

        $lines = [];
        $current = '';

        foreach (explode(' ', $text) as $word) {
            if (strlen($word) > $this->maxCharactersPerLine) {
                if ($current !== '') {
                    $lines[] = $current;
                    $current = '';
                }

                foreach (str_split($word, $this->maxCharactersPerLine) as $piece) {
                    $lines[] = $piece;
                }

                continue;
            }

            $candidate = $current === '' ? $word : $current . ' ' . $word;
            if (strlen($candidate) > $this->maxCharactersPerLine) {
                $lines[] = $current;
                $current = $word;
            } else {
                $current = $candidate;
            }
        }

        if ($current !== '') {
            $lines[] = $current;
        }

        return $lines;
    }

    private function addLine(string $text, int $fontSize = 11, bool $bold = false): void
    {
        if (count($this->currentLines) >= $this->maxLinesPerPage) {
            $this->flushPage();
        }

        $this->currentLines[] = [
            'text' => $text,
            'font_size' => $fontSize,
            'bold' => $bold,
        ];
    }

    private function flushPage(): void
    {
        if (!empty($this->currentLines)) {
            $this->pages[] = $this->currentLines;
            $this->currentLines = [];
        }
    }

    private function buildPageStream(array $lines): string
    {
        $stream = "BT\n";
        $y = 742;

        foreach ($lines as $line) {
            $fontSize = $line['font_size'];
            $text = $line['bold'] ? strtoupper($line['text']) : $line['text'];
            $stream .= "/F1 {$fontSize} Tf\n";
            $stream .= "1 0 0 1 50 {$y} Tm (" . $this->escapeText($text) . ") Tj\n";
            $y -= ($fontSize + 8);
        }

        return $stream . "ET";
    }

    private function escapeText(string $text): string
    {
        $text = preg_replace('/[^\x09\x0A\x0D\x20-\x7E]/', '', $text);
        return str_replace(['\\', '(', ')'], ['\\\\', '\(', '\)'], $text ?? '');
    }
}
