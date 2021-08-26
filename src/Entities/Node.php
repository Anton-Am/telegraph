<?php

namespace AntonAm\Telegraph\Entities;

use AntonAm\Telegraph\Exceptions\NodeException;

/**
 * Class Node
 *
 * @package  AntonAm\Telegraph\Entities
 * @url https://telegra.ph/api#NodeElement
 */
class Node extends Base
{
    public $tag;
    public $attrs;
    public $children;

    public function validate(): self
    {
        if (!empty($this->tag) && !in_array($this->tag, ['a', 'aside', 'b', 'blockquote', 'br', 'code', 'em', 'figcaption', 'figure', 'h3', 'h4', 'hr', 'i', 'iframe', 'img', 'li', 'ol', 'p', 'pre', 's', 'strong', 'u', 'ul', 'video'], false)) {
            throw new NodeException('Unknown tag. Available tags: a, aside, b, blockquote, br, code, em, figcaption, figure, h3, h4, hr, i, iframe, img, li, ol, p, pre, s, strong, u, ul, video.');
        }

        if (!empty($this->attrs) && count($this->attrs) > 0) {
            foreach ($this->attrs as $attrKey => $attrValue) {
                if (!in_array($attrKey, ['href', 'src'], false)) {
                    throw new NodeException('Unknown attribute. Available attributes: href, src');
                }
            }
        }

        return $this;
    }
}