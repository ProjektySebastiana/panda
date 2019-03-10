<?php

echo <<<ARTICLE
        <article>
            <p class="details">
                <span class="date">
                    {$article->getDate($art)}
                </span>
                <span class="author">
                    Author: <b><i>{$art['first_name']} {$art['last_name']}</i></b>
                </span>
            </p>
            <form method="POST" class="article">
                <input type="text" name="name" value="{$art['name']}" placeholder="Article title...">
                <div class="description">
                    <textarea name="description">{$art['description']}</textarea>
                </div>
                <div class="buttons">
                    <button type="submit" class="btn btn-success">UPDATE</button>
                </div>
            </form>
        </article>
ARTICLE;
