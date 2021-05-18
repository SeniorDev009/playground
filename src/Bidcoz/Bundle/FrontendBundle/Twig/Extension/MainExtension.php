<?php

namespace Bidcoz\Bundle\FrontendBundle\Twig\Extension;

use Bidcoz\Bundle\CoreBundle\Entity\Campaign;
use Bidcoz\Bundle\CoreBundle\Twig\Extension\CoreExtension;
use Bidcoz\Bundle\CoreBundle\Util\TextManipulator;
use JMS\DiExtraBundle\Annotation as DI;

/**
 * MainExtension.
 *
 * @DI\Service("bidcoz.twig.main")
 * @DI\Tag("twig.extension")
 */
class MainExtension extends CoreExtension
{
    const DATE_FORMAT_LONG  = 'M d, Y h:i a T';
    const DATE_FORMAT_SHORT = 'm/d/y';

    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter('money', [$this, 'formatMoney']),
            new \Twig_SimpleFilter('date_short', [$this, 'formatDateShort']),
            new \Twig_SimpleFilter('date_long', [$this, 'formatDateLong']),
            new \Twig_SimpleFilter('realescape', [$this, 'realescape']),
        ];
    }

    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('format_date', [$this, 'formatDate']),
        ];
    }

    public function formatMoney($val)
    {
        return sprintf('$%s', number_format($val, 2));
    }

    public function formatDateShort(\DateTime $date = null, $nullDateStr = 'No Date Available')
    {
        if ($date) {
            $date->setTimezone(new \DateTimeZone($this->getUserTimezone()));

            return $date->format(self::DATE_FORMAT_SHORT);
        } else {
            return $nullDateStr;
        }
    }

    public function formatDateLong(\DateTime $date = null, Campaign $campaign = null, $nullDateStr = 'No Date Available')
    {
        if ($date) {
            $date->setTimezone(new \DateTimeZone($this->getUserTimezone($campaign)));

            return $date->format(self::DATE_FORMAT_LONG);
        } else {
            return $nullDateStr;
        }
    }

    public function formatDate(\DateTime $date = null, string $format, Campaign $campaign = null): string
    {
        if ($date) {
            $theDate = clone $date;
            $theDate->setTimezone(new \DateTimeZone($this->getUserTimezone($campaign)));

            return $theDate->format($format);
        } else {
            return '';
        }
    }

    public function realescape($str)
    {
        return TextManipulator::escape($str);
    }

    public function getName()
    {
        return 'bidoz.main';
    }
}
