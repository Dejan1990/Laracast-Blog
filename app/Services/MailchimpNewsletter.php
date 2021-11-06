<?php

namespace App\Services;

use MailchimpMarketing\ApiClient;

class MailchimpNewsletter implements Newsletter
{
    /*public function __construct(protected ApiClient $client)
    {
        protected ApiClient $client -> this is allowed in version php 8, I think  
    }*/

    public function __construct(ApiClient $client)
    {
        // don't work without php 8
    }

    public function subscribe(string $email, string $list = null)
    {
        $list ??= config('services.mailchimp.lists.subscribers');

        return $this->client->lists->addListMember($list, [
            'email_address' => $email,
            'status' => 'subscribed'
        ]);
    }
}