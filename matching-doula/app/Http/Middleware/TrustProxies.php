<?php

namespace App\Http\Middleware;

use Fideloper\Proxy\TrustProxies as Middleware;
use Illuminate\Http\Request;

class TrustProxies extends Middleware
{
    /**
     * The trusted proxies for this application.
     *
     * @var array|string|null
     */

    //AWS Elastic Load Balancingを使用するため変更
    protected $proxies = '*';

    /**
     * The headers that should be used to detect proxies.
     *
     * @var int
     */

    //AWS Elastic Load Balancingを使用するため変更
    protected $headers = Request::HEADER_X_FORWARDED_AWS_ELB;
}
