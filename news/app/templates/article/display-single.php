<?php

$brief = isset($brief) ? ' class="brief"' : '';

echo <<<ARTICLE
        <article{$brief}>
            <p class="details">
                <span class="date">
                    {$article->getDate($art)}
                </span>
                <span class="author">
                    Author: <b>{$art['first_name']} {$art['last_name']}</b>
                </span>
            </p>
            <h2>{$art['name']}</h2>
            <div class="description">
                {$art['description']}
            </div>
            <div class="buttons">
                {$article->getNavigation($art)}
            </div>
        </article>
ARTICLE;
