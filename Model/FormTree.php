<?php

/*
 * This file is part of the ElaoFormTranslation bundle.
 *
 * Copyright (C) Elao
 *
 * @author Elao <contact@elao.com>
 */

namespace Elao\Bundle\FormTranslationBundle\Model;

/**
 * A form Tree
 *
 * @author Thomas Jarrand <thomas.jarrand@gmail.com>
 */
class FormTree implements \Iterator, \Countable, \ArrayAccess
{
    /**
     * The FormTreeNode elements
     *
     * @var array
     */
    private $nodes;

    /**
     * Current position in the loop
     *
     * @var int
     */
    private $position = 0;

    /**
     * Constructor
     *
     * @param array $nodes
     */
    public function __construct($nodes = [])
    {
        $this->nodes = $nodes;
    }

    /**
     * Add a parent node to the beginning of the tree
     *
     * @param FormTreeNode $node The node
     *
     * @return int The new number of elements in the Tree
     */
    public function addParent(FormTreeNode $node)
    {
        return array_unshift($this->nodes, $node);
    }

    /**
     * Add a child node to the end of the tree
     *
     * @param FormTreeNode $node The node
     *
     * @return int The new number of elements in the Tree
     */
    public function addChild(FormTreeNode $node)
    {
        return array_push($this->nodes, $node);
    }

    /**
     * Set the loop back to the start
     *
     * @return void
     */
    #[\ReturnTypeWillChange]
    public function rewind()
    {
        $this->position = 0;
    }

    /**
     * Return the length of the tree
     */
    public function count(): int
    {
        return \count($this->nodes);
    }

    /**
     * Return the current Node in the loop
     *
     * @return FormTreeNode
     */
    #[\ReturnTypeWillChange]
    public function current()
    {
        return $this->nodes[$this->position];
    }

    /**
     * Return the current position in the loop
     *
     * @return int
     */
    #[\ReturnTypeWillChange]
    public function key()
    {
        return $this->position;
    }

    /**
     * Increment current position
     *
     * @return void
     */
    #[\ReturnTypeWillChange]
    public function next()
    {
        ++$this->position;
    }

    /**
     * Return whether or not the current position is valid
     *
     * @return int
     */
    #[\ReturnTypeWillChange]
    public function valid()
    {
        return $this->offsetExists($this->position);
    }

    /**
     * Return whether or not the given offset exists
     *
     * @param mixed $offset
     *
     * @return bool
     */
    #[\ReturnTypeWillChange]
    public function offsetExists($offset)
    {
        return isset($this->nodes[$offset]);
    }

    /**
     * Get the node at the given offset
     *
     * @param mixed $offset
     *
     * @return FormTreeNode
     */
    #[\ReturnTypeWillChange]
    public function offsetGet($offset)
    {
        return $this->offsetExists($offset) ? $this->nodes[$offset] : null;
    }

    /**
     * Set the node at the given offset
     *
     * @param mixed $offset
     * @param mixed $value
     *
     * @return void
     */
    #[\ReturnTypeWillChange]
    public function offsetSet($offset, $value)
    {
        /* Not implemented: Use addParent and addChild methods */
    }

    /**
     * Unset node at the given offset
     *
     * @param mixed $offset
     *
     * @return void
     */
    #[\ReturnTypeWillChange]
    public function offsetUnset($offset)
    {
        /* Not implemented: FormTree nodes should not be unsetable */
    }
}
