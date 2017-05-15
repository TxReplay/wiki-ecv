<?php

namespace AppBundle\Model;

interface StatusInterface
{
    const STATUS_ONLINE = 'online';
    const STATUS_PENDING  = 'pending_validation';
    const STATUS_CANCELED   = 'canceled';
    const STATUS_DRAFT   = 'draft';
}