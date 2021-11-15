<?php declare(strict_types = 1);
namespace noxkiwi\stack\StackOf;

use noxkiwi\stack\Stack\StackInterface;

/**
 * I represent a Stack of elements of the same type.
 */
interface StackOfInterface extends StackInterface
{
    /**
     * I will call the given $function for EACH element in the Stack.
     *
     * @param callable $function
     */
    public function each(callable $function): void;

    /**
     * I will solely return the type of the Stack elements.
     * @return string
     */
    public function getType(): string;
}
