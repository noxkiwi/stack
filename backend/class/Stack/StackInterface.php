<?php declare(strict_types = 1);
namespace noxkiwi\stack\Stack;

use Countable;
use Iterator;
use noxkiwi\stack\Stack;

/**
 * I represent a stack of arbitrary objects.
 */
interface StackInterface extends Iterator, Countable
{
    /**
     * I will add the given $element to the stack of elements in the Iterator.
     *
     * @param $element
     *
     * @return \noxkiwi\stack\Stack
     */
    public function add($element): Stack;

    /**
     * I will remove the given $element from the elements.
     *
     * @param $element
     *
     * @return \noxkiwi\stack\Stack
     */
    public function remove($element): Stack;
}
