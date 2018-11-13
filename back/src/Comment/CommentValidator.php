<?php
namespace Comment;

class CommentValidator
{
    public function validate($comment) {
        if (
            is_null($comment) ||
            !property_exists($comment, 'idUser') ||
            !property_exists($comment, 'idBar') ||
            !property_exists($comment, 'content')
        ) {
            return false;
        }
        return true;
    }
}
