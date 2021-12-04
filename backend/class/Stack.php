<?php declare(strict_types = 1);
namespace noxkiwi\stack;

use noxkiwi\stack\Stack\StackInterface;

/**
 * Class Stack
 * @package noxkiwi\stack
 */
class Stack implements StackInterface
{
    /** @var array I am the list of elements on the stack. */
    private array $elements;
    /** @var int I am the position for the \Iterator interface. */
    private int $position;

    public function __construct()
    {
        $this->elements = [];
        $this->position = 0;
    }

    /**
     * @inheritDoc
     */
    public function rewind(): void
    {
        $this->position = 0;
    }

    /**
     * @inheritDoc
     */
    public function current(): mixed
    {
        return $this->elements[$this->position];
    }

    /**
     * @inheritDoc
     */
    public function key(): int
    {
        return $this->position;
    }

    /**
     * @inheritDoc
     */
    public function next(): void
    {
        ++$this->position;
    }

    /**
     * @inheritDoc
     */
    public function valid(): bool
    {
        return isset($this->elements[$this->position]);
    }

    /**
     * @inheritDoc
     */
    public function add($element): Stack
    {
        $this->elements[] = $element;

        return $this;
    }

    /**
     * @inheritDoc
     */
    final public function count(): int
    {
        return count($this->elements);
    }

    /**
     * @inheritDoc
     */
    final public function remove($element): Stack
    {
        foreach ($this->elements as $elementKey => $myElement) {
            if ($element !== $myElement) {
                continue;
            }
            unset($this->elements[$elementKey]);
        }

        return $this;
    }

    /**
     * I will reset the entire stack by removing all elements.
     */
    public function reset(): void
    {
        $this->elements = [];
    }

    /**
     * I will return all elements on the stack.
     * @return array
     */
    public function getAll(): array
    {
        return $this->elements;
    }
}
