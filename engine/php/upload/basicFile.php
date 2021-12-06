<?php

namespace upload;

interface basicFile
{

    public function __invoke(): void;
    public function loadFiles(iterable $files): void;
    public function setResolution(?int $width = null, ?int $height = null): void;
    public function setProduct(string $product): void;
}
