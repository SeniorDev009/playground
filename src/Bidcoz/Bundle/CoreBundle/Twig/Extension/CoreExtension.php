<?php

namespace Bidcoz\Bundle\CoreBundle\Twig\Extension;

use Bidcoz\Bundle\CoreBundle\Util\TextManipulator;
use Twig_Extension;
use Twig_Extension_GlobalsInterface;

class CoreExtension extends Twig_Extension implements Twig_Extension_GlobalsInterface
{
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('truncateText', [$this, 'truncateText']),
        ];
    }

    public function getName()
    {
        return 'bidcoz.core';
    }

    public function truncateText(string $text, int $maxLen, string $additionalText = '...')
    {
        return TextManipulator::truncateText($text, $maxLen, $additionalText);
    }
}
