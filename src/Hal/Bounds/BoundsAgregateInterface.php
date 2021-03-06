<?php

/*
 * (c) Jean-François Lépine <https://twitter.com/Halleck45>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Hal\Bounds;
use Hal\Result\ResultCollection;

/**
 * Bounds calculator
 *
 * @author Jean-François Lépine <https://twitter.com/Halleck45>
 */
interface BoundsAgregateInterface {

    /**
     * Calculate
     *
     * @param ResultCollection $collection
     * @return array
     */
    public function calculate(ResultCollection $collection);
}