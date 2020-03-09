<?php

namespace YogaCMS\UI\Builders;

use Str;
use Admin;
use YogaCMS\UI\Utils\Arr;
use YogaCMS\UI\Builders\Menu\Item;

class MenuBuilder
{

    /**
     * Sidebar Logo
     *
     */
    public $logo = 'https://logodownload.org/wp-content/uploads/2019/07/loggi-logo.png';

    /**
     * Home Page
     *
     */
    public $home;

    /**
     * Sidebar Sections
     *
     */
    public $sections = [];

    /**
     * Sidebar Footer Items
     *
     */
    public $footerItems = [];

    /**
     * Menu Items Filters
     *
     */
    public $filters = [];

    /**
     * Constructor Method
     *
     */
    function __construct()
    {
    }

    /**
     * Add Filters to the Sidebar
     *
     */
    function addFilter($filters)
    {
        if (is_array($filters)) {
            $this->filters = array_merge($filters, $this->filters);
            return;
        }
        $this->filters[] = $filters;
    }

    /**
     * Add Footer Items
     *
     */
    function addFooterItem($name, $options = [])
    {
        $this->footerItems[Str::slug($name)] = new Item($name, $options);
        return $this;
    }

    /**
     * Add Logo to Sidebar
     *
     */
    function addLogo($logo, $home = '')
    {
        $this->logo = $logo;
        $this->home = $home;
        return $this;
    }

    /**
     * Print Home Link
     *
     */
    function printHomeLink()
    {
        return sprintf('onclick="location.href = \'%s\'"', $this->home);
    }

    /**
     * Select a Sidebar Section
     *
     */
    function on($name)
    {
        $sectionSlug = Str::slug($name);
        return $this->sections[$sectionSlug]->clearContext();
    }

    /**
     * Add new Item do Sidebar
     *
     */
    function addItem($name, $options = [])
    {
        $this->sections[Str::slug($name)] = new Item($name, $options);
        return $this;
    }

    /**
     * Insert an Section After Another
     *
     */
    function addItemAfter($sectionSlug, $newSectionName)
    {
        Arr::insertAfter($this->sections, $sectionSlug, [
            Str::slug($newSectionName) => new Item($newSectionName)
        ]);
        return $this;
    }

    /**
     * Insert an Section Before Another
     *
     */
    function addItemBefore($sectionSlug, $newSectionName)
    {
        Arr::insertBefore($this->sections, $sectionSlug, [
            Str::slug($newSectionName) => new Item($newSectionName)
        ]);
        return $this;
    }

    /**
     * Get Menu Items
     *
     */
    function getItems()
    {
        return collect($this->sections)->filter(function($item) {
            foreach($this->filters as $filter) {
                if (!$item->filter($filter)) {
                    return false;
                }
            }
            return true;
        })->toArray();
    }

    /**
     * Get Footer Items
     *
     */
    function getFooterItems()
    {
        return collect($this->footerItems)->filter(function($item) {
            foreach($this->filters as $filter) {
                if (!$item->filter($filter)) {
                    return false;
                }
            }
            return true;
        })->toArray();
    }

    /**
     * Inititalize the sidebar builder
     *
     */
    function __init__()
    {
        return $this;
    }
}
