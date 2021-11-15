<?php declare(strict_types = 1);
namespace noxkiwi\stack;

use noxkiwi\stack\StackOf\StackOfInterface;
use function class_exists;
use function is_array;
use function is_bool;
use function is_float;
use function is_int;
use function is_object;
use function is_string;

/**
 * I am
 * Class StackOf
 * @package noxkiwi\stack
 */
class StackOf extends Stack implements StackOfInterface
{
    /** @var string I am the name of the type. */
    private string $type;

    /**
     * I will construct the StackOf object.
     * I will use the given $type to set the type of the stack.
     * Also, I will automatically add the given $entries.
     *
     * @param string     $type
     * @param array|null $entries
     */
    public function __construct(string $type, array $entries = null)
    {
        parent::__construct();
        $this->setType($type);
        $this->add($entries ?? []);
    }

    /**
     * @inheritDoc
     */
    public function add($element): Stack
    {
        if ($element === null) {
            return $this;
        }
        if (is_array($element)) {
            return $this->addElements($element);
        }
        // @formatter:off
        if (
            $this->type === 'string'      && is_string($element)
         || $this->type === 'int'         && is_int($element)
         || $this->type === 'float'       && is_float($element)
         || $this->type === 'bool'        && is_bool($element)
         || interface_exists($this->type) && $element instanceof $this->type
         || class_exists($this->type)     && $element instanceof $this->type
        ){
        // @formatter:on
            parent::add($element);
        }

        return $this;
    }

    /**
     * I will add all given $elements separately into the Stack.
     *
     * @param array $elements
     *
     * @return \noxkiwi\stack\Stack
     */
    public function addElements(array $elements): Stack
    {
        foreach ($elements as $myElement) {
            if (is_array($myElement)) {
                continue;
            }
            $this->add($myElement);
        }

        return $this;
    }

    /**
     * @inheritDoc
     */
    final public function getType(): string
    {
        return $this->type;
    }

    /**
     * I'll solely set the type of the Stack.
     *
     * @param string $type
     */
    final protected function setType(string $type): void
    {
        $this->type = $type;
    }

    /**
     * @inheritDoc
     */
    final public function each(callable $function, array $args = []): void
    {
        foreach ($this as $element) {
            $function($element, $args);
        }
    }

    /**
     * Use with caution. I will call the desired $methodName on all elements in the StackOf.
     *
     * @param string     $methodName
     * @param array|null $methodArguments
     *
     * @return \noxkiwi\stack\StackOf
     */
    final public function __call(string $methodName, array $methodArguments = null): self
    {
        if (empty($this->getAll())) {
            return $this;
        }
        if (! is_object($this->getAll()[0])) {
            return $this;
        }
        if (! method_exists($this->getAll()[0], $methodName)) {
            return $this;
        }
        foreach ($this->getAll() as $item) {
            $item->{$methodName}($methodArguments);
        }

        return $this;
    }
}
