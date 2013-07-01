<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jones\WebArtisan\Cli;

use Symfony\Component\Console\Formatter\OutputFormatterStyleInterface;

/**
 * Formatter style class for defining styles.
 *
 * @author Konstantin Kudryashov <ever.zet@gmail.com>
 *
 * @api
 */
class OutputFormatterStyle implements OutputFormatterStyleInterface {

        private static $availableColors = array(
            'black' => '#000000;',
            'red' => '#FF0000;',
            'green' => '#00FF00;',
            'yellow' => '#FFFF00;',
            'blue' => '#0000FF;',
            'magenta' => '#FF00FF;',
            'cyan' => '#00FFFF;',
            'white' => '#FFFFFF;'
        );
        private static $availableOptions = array(
            'bold' => 'font-weight: bold;',
            'underscore' => 'underline',
            'blink' => 'blink',
            'reverse' => 'direction: rtl;unicode-bidi: bidi-override;',
            'conceal' => 'visibility: hidden;'
        );
        private $foreground;
        private $background;
        private $options = array();

        /**
         * Initializes output formatter style.
         *
         * @param string $foreground The style foreground color name
         * @param string $background The style background color name
         * @param array  $options    The style options
         *
         * @api
         */
        public function __construct($foreground = null, $background = null, array $options = array()) {
                if (null !== $foreground) {
                        $this->setForeground($foreground);
                }
                if (null !== $background) {
                        $this->setBackground($background);
                }
                if (count($options)) {
                        $this->setOptions($options);
                }
        }

        /**
         * Sets style foreground color.
         *
         * @param string $color The color name
         *
         * @throws \InvalidArgumentException When the color name isn't defined
         *
         * @api
         */
        public function setForeground($color = null) {
                if (null === $color) {
                        $this->foreground = null;

                        return;
                }

                if (!isset(static::$availableColors[$color])) {
                        throw new \InvalidArgumentException(sprintf(
                                        'Invalid foreground color specified: "%s". Expected one of (%s)', $color, implode(', ', array_keys(static::$availableColors))
                        ));
                }

                $this->foreground = static::$availableColors[$color];
        }

        /**
         * Sets style background color.
         *
         * @param string $color The color name
         *
         * @throws \InvalidArgumentException When the color name isn't defined
         *
         * @api
         */
        public function setBackground($color = null) {
                if (null === $color) {
                        $this->background = null;

                        return;
                }

                if (!isset(static::$availableColors[$color])) {
                        throw new \InvalidArgumentException(sprintf(
                                        'Invalid background color specified: "%s". Expected one of (%s)', $color, implode(', ', array_keys(static::$availableColors))
                        ));
                }

                $this->background = static::$availableColors[$color];
        }

        /**
         * Sets some specific style option.
         *
         * @param string $option The option name
         *
         * @throws \InvalidArgumentException When the option name isn't defined
         *
         * @api
         */
        public function setOption($option) {
                if (!isset(static::$availableOptions[$option])) {
                        throw new \InvalidArgumentException(sprintf(
                                        'Invalid option specified: "%s". Expected one of (%s)', $option, implode(', ', array_keys(static::$availableOptions))
                        ));
                }

                if (false === array_search(static::$availableOptions[$option], $this->options)) {
                        $this->options[] = static::$availableOptions[$option];
                }
        }

        /**
         * Unsets some specific style option.
         *
         * @param string $option The option name
         *
         * @throws \InvalidArgumentException When the option name isn't defined
         *
         */
        public function unsetOption($option) {
                if (!isset(static::$availableOptions[$option])) {
                        throw new \InvalidArgumentException(sprintf(
                                        'Invalid option specified: "%s". Expected one of (%s)', $option, implode(', ', array_keys(static::$availableOptions))
                        ));
                }

                $pos = array_search(static::$availableOptions[$option], $this->options);
                if (false !== $pos) {
                        unset($this->options[$pos]);
                }
        }

        /**
         * Sets multiple style options at once.
         *
         * @param array $options
         */
        public function setOptions(array $options) {
                $this->options = array();

                foreach ($options as $option) {
                        $this->setOption($option);
                }
        }

        /**
         * Applies the style to a given text.
         *
         * @param string $text The text to style
         *
         * @return string
         */
        public function apply($text) {
                $style = '';

                if (null !== $this->foreground) {
                        $style = 'color:' . $this->foreground;
                }
                if (null !== $this->background) {
                        $style.= 'background-color:' . $this->background;
                }
                if (count($this->options)) {
                        $text_decoration = 'text-decoration:';

                        foreach ($this->options as $option => $value) {
                                if ('blink' == $value)
                                        $text_decoration.= ' ' . $value;
                                else if ('underline' == $value) {
                                        $text_decoration.= ' ' . $value;
                                } else {
                                        $style .= $value;
                                }
                        }
                        $style .= $text_decoration . ';';
                }

                if (0 === strlen($style)) {
                        return $text;
                }
                return '<span style="'.$style.'">'.$text.'</span>';
        }

}