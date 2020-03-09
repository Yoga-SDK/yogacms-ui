<?php

namespace YogaCMS\UI\Builders\Menu;

use Str;
use Yoga\Admin\Utils\Arr;

class Item
{
    /**
     * Item Text
     *
     */
    public $text;

    /**
     * Item Slug
     *
     */
    public $slug;

    /**
     * Menu Icon
     *
     */
    public $icon;

    /**
     * Menu URL
     *
     */
    public $url;

    /**
     * Link that indicates if the menu is active
     *
     */
    public $activeLink = '';

    /**
     * Item Children
     *
     */
    public $children = [];
    
    /**
     * Item Insertion Context
     *
     */
    public $context = 'last';

    /**
     * Item Insert Context Item
     *
     */
    public $contextItem = '';

    /**
     * Constructor Method
     *
     */
    function __construct($text, $options = [])
    {
        $this->text = $text;
        $this->slug = Str::slug($text);

        foreach($options as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * Gets Item Text
     *
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Gets the Menu Child Id
     *
     */
    public function getId($prefix = null)
    {
        return sprintf('%s%s-menu-item', $prefix ? $prefix.'-' : '', $this->slug);
    }

    /**
     * Print the Item Icon
     *
     */
    public function printIcon()
    {
        if (!$this->icon) {
            return '';
        }

        if (Str::startsWith($this->icon, 'fa')) {
            return sprintf('<i class="fa %s"></i>', $this->icon);
        }
        return sprintf('<ion-icon name="%s"></ion-icon>', $this->icon);
    }

    /**
     * Print the Item Menu
     *
     */
    public function printUrl()
    {
        if (!$this->url) return '';

        return sprintf('onclick="location.href = \'%s\'"', admin_url($this->url));
    }

    /**
     * Indicates if a menu item is active
     *
     */
    public function isActive($ifTrue = true, $ifFalse = false)
    {
        foreach($this->children as $child) {
            if ($child->isActive(true, false)) {
                return $ifTrue;
            }
        }

        return $this->url && request()->is($this->activeLink) ? $ifTrue : $ifFalse;
    }

    /**
     * Add a Item to Context
     *
     */
    public function on($name)
    {
        $slug = Str::slug($name);
        return $this->children[$slug]->clearContext();
    }

    /**
     * Clear Context
     *
     */
    public function clearContext()
    {
        $this->contextItem = '';
        $this->context = 'last';
        return $this;
    }

    /**
     * Set Context as First
     *
     */
    public function first()
    {
        $this->context = 'first';
        return $this;
    }

    /**
     * Set Context as Before
     *
     */
    public function before($item)
    {
        $this->context = 'before';
        $this->contextItem = $item;
        return $this;
    }

    /**
     * Set Context as After
     *
     */
    public function after($item)
    {
        $this->context = 'after';
        $this->contextItem = $item;
        return $this;
    }
    
    /**
     * Set Context as Item
     *
     */
    public function addItem($itemName, $options = [])
    {
        $menuItem = new Item($itemName, $options);
        $slug = Str::slug($itemName);

        switch($this->context) {
            case 'before':
                Arr::insertBefore($this->children, $this->contextItem, [$slug => $menuItem ]);
            break;
            case 'after':
                Arr::insertAfter($this->children, $this->contextItem, [$slug => $menuItem ]);
            break;
            case 'first':
                $this->children = array_merge([$slug => $menuItem], $this->children);
            break;
            case 'last':
                $this->children[$slug] = $menuItem;
            break;
        }

        return $this->children[$slug];
    }

    /**
     * Check if the Menu Item has Children
     *
     */
    public function hasChildren()
    {
        return count($this->children) > 0;
    }

    /**
     * Apply Filter to Item
     *
     */
    public function filter($filter)
    {
        $this->children = collect($this->children)
        ->filter(function($child) use ($filter) {
            return $child->filter($filter);
        });
        return $filter($this);
    }
}
