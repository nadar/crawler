<?php

namespace Nadar\Crawler\Tests\Parsers;

use Nadar\Crawler\Job;
use Nadar\Crawler\Parsers\HtmlParser;
use Nadar\Crawler\RequestResponse;
use Nadar\Crawler\Tests\CrawlerTestCase;
use Nadar\Crawler\Url;

class HtmlParserExampleTest extends CrawlerTestCase
{
    public function testFullIgnoreResult()
    {
        $job = new Job(new Url('https://example.com/'), new Url('https://example.com/'));

        $requestResponse = new RequestResponse($this->html, 'text/html', 200);

        $parser = new HtmlParser();
        $result = $parser->run($job, $requestResponse);

        // "Standortmarketing" should not exists as its inside the crawl igore anotation
        $this->assertStringNotContainsString('Standortmarketing', $result->content);
    }

    public $html = <<<'EOT'
   
<!DOCTYPE html>
<html lang="de">
    <head>
        <meta charset="UTF-8" />
        <meta name="robots" content="index, follow" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
		<link rel="icon" type="image/png" href="/favicon-32x32.png" sizes="32x32">
		<link rel="icon" type="image/png" href="/favicon-16x16.png" sizes="16x16">
		<link rel="manifest" href="/manifest.json">
		<link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
		<meta name="theme-color" content="#D02027">        
        <title>Kontakt</title>
        <style>
            .hb-logo-image {
                margin-top:-2px;
            }
        </style>
        <meta name="csrf-param" content="_csrf">
<meta name="csrf-token" content="0xklTU3qKTVWrVg1TeS_l1DPuaaiHhXQMErLzJ9VCsW6S2gPAJphfQHBDXc6g_r0Yfzu9O4sJediGvO20ABIpA==">

<meta name="og:type" content="website">
<meta name="twitter:card" content="summary">
<meta name="og:title" content="Kontakt">
<meta name="twitter:title" content="Kontakt">
<meta name="og:url" content="https://preview.heartbeat.gmbh/ueber-uns/kontakt-support">
<meta name="twitter:url" content="https://preview.heartbeat.gmbh/ueber-uns/kontakt-support">
<link href="//unpkg.com/aos@next/dist/aos.css" rel="stylesheet">
<link href="/assets/43734dbd/dist/main.css" rel="stylesheet">    </head>
    <body>
        <!-- [CRAWL_IGNORE] -->
    <div id="layoutDefault">
            <div id="layoutDefault_content">
                <main>
                                        <nav class="navbar navbar-marketing navbar-expand-lg bg-transparent navbar-dark fixed-top">
                                            <div class="container">
                            <a class="navbar-brand ml-2" href="/"><!--
                                                            --><?xml version="1.0" encoding="UTF-8" standalone="no"?><!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN" "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd">
<svg width="20" height="100%" viewBox="0 0 1000 921" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" xmlns:serif="http://www.serif.com/" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;"><path d="M205.978,546.227l-0,-84.669l101.387,0l-0,195.011c-36.332,-37.864 -70.683,-75.11 -101.387,-110.342m527.214,-63.696l113.993,-0c-31.767,40.111 -70.837,84.726 -113.993,131.137l0,-131.137Zm-202.774,335.303l-0,-461.14l141.941,0l0,94.337c0,0.014 -0.003,0.027 -0.003,0.041c0,0.014 0.003,0.027 0.003,0.041l0,226.453c-45.81,47.095 -94.175,94.733 -141.941,140.268Zm-162.22,-251.412l101.388,0l0,251.401c-33.869,-32.287 -68.039,-65.628 -101.388,-99.089l-0,-152.312Zm-290.894,-367.383c22.208,-54.968 63.859,-97.547 117.278,-119.897c52.718,-22.057 110.59,-21.562 162.951,1.4c52.358,22.96 92.94,65.636 114.267,120.166c0.034,0.09 0.081,0.171 0.116,0.26c0.215,0.535 0.464,1.052 0.707,1.575c0.194,0.417 0.373,0.846 0.582,1.25c0.251,0.484 0.538,0.945 0.814,1.415c0.24,0.413 0.465,0.839 0.723,1.236c0.305,0.473 0.649,0.919 0.98,1.375c0.261,0.358 0.502,0.732 0.776,1.076c0.577,0.728 1.194,1.424 1.837,2.099c0.042,0.046 0.08,0.096 0.123,0.141c1.916,1.991 4.129,3.714 6.577,5.143c0.171,0.1 0.333,0.215 0.506,0.312c0.573,0.319 1.177,0.599 1.778,0.883c0.316,0.15 0.625,0.317 0.947,0.456c0.114,0.049 0.218,0.111 0.332,0.159c0.483,0.203 0.974,0.351 1.461,0.524c0.337,0.123 0.671,0.256 1.013,0.364c0.648,0.207 1.301,0.373 1.953,0.533c0.301,0.073 0.597,0.157 0.899,0.22c0.689,0.146 1.377,0.254 2.066,0.349c0.285,0.04 0.566,0.086 0.85,0.117c0.703,0.077 1.403,0.115 2.103,0.14c0.287,0.011 0.573,0.028 0.861,0.031c0.703,0.004 1.401,-0.028 2.1,-0.073c0.29,-0.02 0.581,-0.031 0.872,-0.059c0.714,-0.069 1.422,-0.174 2.126,-0.293c0.273,-0.048 0.546,-0.084 0.818,-0.139c0.76,-0.151 1.51,-0.342 2.256,-0.553c0.213,-0.06 0.426,-0.109 0.637,-0.174c0.858,-0.262 1.698,-0.569 2.529,-0.907c0.086,-0.035 0.174,-0.058 0.26,-0.094c0.02,-0.009 0.039,-0.02 0.06,-0.028c0.934,-0.394 1.851,-0.832 2.743,-1.319l0.024,-0.011c5.811,-3.179 10.64,-8.323 13.509,-14.963c0.095,-0.222 0.204,-0.436 0.297,-0.661c0.051,-0.126 0.116,-0.242 0.165,-0.37c21.327,-54.528 61.909,-97.204 114.267,-120.166c52.361,-22.962 110.23,-23.457 162.951,-1.4c53.419,22.351 95.069,64.932 117.279,119.899c21.783,53.907 21.916,113.049 0.377,166.526c-6.236,15.483 -16.418,33.697 -29.81,54.032l-160.072,0l0,-94.379c0,-17.374 -13.619,-31.459 -30.417,-31.459l-202.773,0c-16.798,0 -30.416,14.085 -30.416,31.459l0,178.271l-101.388,-0l-0,-73.406c-0,-17.374 -13.618,-31.46 -30.416,-31.46l-162.22,0c-16.798,0 -30.417,14.086 -30.417,31.46l-0,42.636c-32.849,-42.323 -56.947,-79.182 -68.218,-107.168c-21.54,-53.479 -21.405,-112.62 0.377,-166.528m901.925,190.737c27.832,-69.105 27.69,-145.454 -0.403,-214.981c-28.52,-70.589 -82.005,-125.267 -150.596,-153.965c-67.787,-28.361 -142.194,-27.723 -209.507,1.8c-48.723,21.366 -89.504,56.017 -118.718,100.107c-29.214,-44.097 -69.999,-78.753 -118.728,-100.123c-67.318,-29.52 -141.722,-30.159 -209.507,-1.798c-68.591,28.696 -122.074,83.375 -150.595,153.962c-28.094,69.528 -28.236,145.877 -0.404,214.984c19.778,49.104 69.768,116.519 130.521,187.266c1.021,1.398 2.144,2.708 3.374,3.912c114.179,132.33 264.667,275.32 324.99,331.476c0.012,0.013 0.027,0.023 0.04,0.035c0.162,0.15 0.334,0.28 0.497,0.425c0.361,0.322 0.731,0.629 1.106,0.933c0.262,0.212 0.519,0.434 0.784,0.636c0.194,0.147 0.392,0.285 0.59,0.426c0.31,0.223 0.628,0.431 0.947,0.641c0.338,0.225 0.674,0.451 1.019,0.66c0.213,0.129 0.426,0.261 0.641,0.384c0.265,0.153 0.54,0.289 0.811,0.434c0.413,0.22 0.826,0.43 1.247,0.629c0.224,0.106 0.442,0.225 0.667,0.324c0.229,0.101 0.465,0.187 0.697,0.282c0.48,0.2 0.965,0.379 1.452,0.552c0.234,0.083 0.466,0.186 0.704,0.265c0.185,0.06 0.378,0.104 0.565,0.161c0.522,0.159 1.049,0.291 1.576,0.42c0.181,0.043 0.353,0.101 0.533,0.141c0.101,0.023 0.197,0.058 0.296,0.079c0.129,0.028 0.263,0.041 0.392,0.066c0.602,0.121 1.207,0.205 1.815,0.287c0.192,0.026 0.379,0.068 0.573,0.09c0.163,0.02 0.326,0.041 0.489,0.058c0.824,0.081 1.649,0.119 2.475,0.13c0.149,0.003 0.297,0.024 0.446,0.024c0.99,0 1.98,-0.06 2.967,-0.16c0.241,-0.025 0.476,-0.07 0.716,-0.099c0.721,-0.092 1.44,-0.197 2.155,-0.341c0.327,-0.066 0.645,-0.15 0.968,-0.228c0.617,-0.146 1.233,-0.303 1.845,-0.491c0.165,-0.05 0.335,-0.092 0.499,-0.146c0.182,-0.058 0.357,-0.138 0.537,-0.202c0.573,-0.199 1.138,-0.411 1.701,-0.645c0.201,-0.084 0.406,-0.16 0.604,-0.248c0.187,-0.084 0.37,-0.18 0.554,-0.267c0.497,-0.233 0.985,-0.481 1.472,-0.743c0.23,-0.125 0.464,-0.244 0.69,-0.375c0.192,-0.108 0.38,-0.22 0.569,-0.334c0.415,-0.249 0.819,-0.519 1.224,-0.791c0.269,-0.181 0.539,-0.36 0.802,-0.55c0.183,-0.13 0.369,-0.254 0.551,-0.39c0.332,-0.249 0.652,-0.524 0.976,-0.791c0.301,-0.247 0.598,-0.495 0.891,-0.753c0.106,-0.094 0.217,-0.177 0.323,-0.274c0.069,-0.062 0.143,-0.115 0.212,-0.178c0.027,-0.025 0.057,-0.046 0.082,-0.072c40.294,-37.512 120.831,-113.781 203.898,-199.728c0.019,-0.018 0.036,-0.036 0.054,-0.056c76.929,-79.596 155.992,-167.47 207.3,-240.585c1.468,-1.691 2.769,-3.536 3.858,-5.528c19.592,-28.418 34.791,-54.468 43.763,-76.747" style="fill:#ffffff;fill-rule:nonzero;"/></svg><!--
                                                        -->Heartbeat GmbH</a><button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i data-feather="menu"></i></button>
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav ml-auto mr-lg-5">
                                                                                                                        <li class="nav-item"><a class="nav-link " href="/">Startseite</a></li>
                                                                                                                                                                <li class="nav-item dropdown no-caret">
                                                <a class="nav-link  dropdown-toggle" id="navbarDropdownDocs" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Content Hub<i class="fas fa-chevron-right dropdown-arrow"></i></a>
                                                <div class="dropdown-menu dropdown-menu-right animated--fade-in-up" aria-labelledby="navbarDropdownDocs">
                                                                                                        <a class="dropdown-item py-3 " href="/content-hub/landingpage-contenthub"
                                                    ><div class="icon-stack bg-primary text-white mr-3"><i class="fas fa-binoculars"></i></div>                                                        <div>
                                                            <div class="small">Das ist der Heartbeat Content Hub</div>
                                                            Überblick                                                        </div></a
                                                    >
                                                                                                            <div class="dropdown-divider m-0"></div>
                                                                                                                                                            <a class="dropdown-item py-3 " href="/content-hub/usecases"
                                                    ><div class="icon-stack bg-primary text-white mr-3"><i class="fas fa-users"></i></div>                                                        <div>
                                                            <div class="small">Flexibel einsetzbar</div>
                                                            Einsatzmöglichkeiten                                                        </div></a
                                                    >
                                                                                                            <div class="dropdown-divider m-0"></div>
                                                                                                                                                            <a class="dropdown-item py-3 " href="/content-hub/content-hub-city-manager-standortmarketing"
                                                    ><div class="icon-stack bg-primary text-white mr-3"><i class="fas fa-map-marker"></i></div>                                                        <div>
                                                            <div class="small">Wirkungsvolles Standortmarketing</div>
                                                            Content Hub für City Manager                                                        </div></a
                                                    >
                                                                                                                                                        </div>
                                            </li>
                                                                                                                                                                <li class="nav-item"><a class="nav-link " href="/methodik">Methodik</a></li>
                                                                                                                                                                <li class="nav-item dropdown no-caret">
                                                <a class="nav-link  dropdown-toggle" id="navbarDropdownDocs" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Success Stories<i class="fas fa-chevron-right dropdown-arrow"></i></a>
                                                <div class="dropdown-menu dropdown-menu-right animated--fade-in-up" aria-labelledby="navbarDropdownDocs">
                                                                                                        <a class="dropdown-item py-3 " href="/showcases/basellive"
                                                    ><div class="icon-stack bg-primary text-white mr-3"><i class="fas fa-map-marker"></i></div>                                                        <div>
                                                            <div class="small">Standortmarketing</div>
                                                            BaselLive                                                        </div></a
                                                    >
                                                                                                            <div class="dropdown-divider m-0"></div>
                                                                                                                                                            <a class="dropdown-item py-3 " href="/showcases/heartbeat-aarau"
                                                    ><div class="icon-stack bg-primary text-white mr-3"><i class="fas fa-map-marker"></i></div>                                                        <div>
                                                            <div class="small">Standortmarketing</div>
                                                            Heartbeat Aarau                                                        </div></a
                                                    >
                                                                                                            <div class="dropdown-divider m-0"></div>
                                                                                                                                                            <a class="dropdown-item py-3 " href="/showcases/meinmittelpunkt-region-aarau"
                                                    ><div class="icon-stack bg-primary text-white mr-3"><i class="fas fa-map-marker"></i></div>                                                        <div>
                                                            <div class="small">Standortmarketing</div>
                                                            Mein Mittelpunkt                                                        </div></a
                                                    >
                                                                                                            <div class="dropdown-divider m-0"></div>
                                                                                                                                                            <a class="dropdown-item py-3 " href="/showcases/lange-nacht-der-kirchen"
                                                    ><div class="icon-stack bg-primary text-white mr-3"><i class="fas fa-magic"></i></div>                                                        <div>
                                                            <div class="small">Grossveranstaltung</div>
                                                            Lange Nacht der Kirchen                                                        </div></a
                                                    >
                                                                                                            <div class="dropdown-divider m-0"></div>
                                                                                                                                                            <a class="dropdown-item py-3 " href="/showcases/projekte"
                                                    ><div class="icon-stack bg-primary text-white mr-3"><i class="fas fa-hand-holding-heart"></i></div>                                                        <div>
                                                            <div class="small"></div>
                                                            Alle Projekte                                                        </div></a
                                                    >
                                                                                                                                                        </div>
                                            </li>
                                                                                                                                                                <li class="nav-item dropdown no-caret">
                                                <a class="nav-link active dropdown-toggle" id="navbarDropdownDocs" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Unternehmen<i class="fas fa-chevron-right dropdown-arrow"></i></a>
                                                <div class="dropdown-menu dropdown-menu-right animated--fade-in-up" aria-labelledby="navbarDropdownDocs">
                                                                                                        <a class="dropdown-item py-3 " href="/ueber-uns/ueber-uns"
                                                    >                                                        <div>
                                                            <div class="small"></div>
                                                            Das Team                                                        </div></a
                                                    >
                                                                                                            <div class="dropdown-divider m-0"></div>
                                                                                                                                                            <a class="dropdown-item py-3 " href="/ueber-uns/blog-updates"
                                                    >                                                        <div>
                                                            <div class="small"></div>
                                                            Blog &amp; Updates                                                        </div></a
                                                    >
                                                                                                            <div class="dropdown-divider m-0"></div>
                                                                                                                                                            <a class="dropdown-item py-3 active" href="/ueber-uns/kontakt-support"
                                                    >                                                        <div>
                                                            <div class="small"></div>
                                                            Kontakt                                                        </div></a
                                                    >
                                                                                                                                                        </div>
                                            </li>
                                                                                                            </ul>
                            </div>
                        </div>
                    </nav>
                    <!-- [/CRAWL_IGNORE] -->
                    <header class="page-header page-header-dark bg-gradient-tertiary-to-secondary">
                        <div class="page-header-content">
                            <div class="container text-center">
                                <div class="row justify-content-center">
                                    <div class="col-lg-8">
                                        <h1 class="page-header-title mb-3">Grüezi, hallo, welcome 👋</h1>
                                        <p class="page-header-text mb-0">Wir freuen uns auf deine Nachricht.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="svg-border-rounded text-light">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 144.54 17.34" preserveAspectRatio="none" fill="currentColor"><path d="M144.54,17.34H0V0H144.54ZM0,0S32.36,17.34,72.27,17.34,144.54,0,144.54,0"></path></svg>
                        </div>
                    </header>
                    <section class="bg-light py-10">
                        <div class="container">
                            <div class="row mb-5">
                                <div class="col-lg-4 mb-5">
                                    <a class="card card-link border-top border-top-lg border-primary lift text-center o-visible h-100" href="/ueber-uns/kontakt-support/kontaktformular"
                                        ><div class="card-body">
                                            <div class="icon-stack icon-stack-xl bg-tertiary-soft text-secondary mb-4 mt-n5 z-1 shadow"><i data-feather="user"></i></div>
                                            <h5>Interessiert an Heartbeat?</h5>
                                            <p class="card-text">Wir zeigen dir unverbindlich, wie Heartbeat deine Kommunikationskanäle optimieren kann.</p>
                                        </div>
                                        <div class="card-footer">
                                            <div class="text-primary font-weight-bold d-inline-flex align-items-center">Kontaktiere uns<i class="fas fa-arrow-right text-xs ml-1"></i></div></div
                                    ></a>
                                </div>
                                <div class="col-lg-4 mb-5">
                                    <a class="card card-link border-top border-top-lg border-primary lift text-center o-visible h-100" href="#!"
                                        ><div class="card-body">
                                            <div class="icon-stack icon-stack-xl bg-tertiary-soft text-secondary mb-4 mt-n5 z-1 shadow"><i data-feather="life-buoy"></i></div>
                                            <h5>Bereits Kunde?</h5>
                                            <p class="card-text">Als Nutzer des Heartbeat Content Hub nutzt du für Anfragen am besten unser Support Tool.</p>
                                        </div>
                                        <div class="card-footer">
                                            <div class="text-primary font-weight-bold d-inline-flex align-items-center">Zum Support Tool<i class="fas fa-arrow-right text-xs ml-1"></i></div></div
                                    ></a>
                                </div>
                                <div class="col-lg-4 mb-5">
                                    <a class="card card-link border-top border-top-lg border-teal lift text-center o-visible h-100" href="https://status.heartbeat.gmbh" target="_blank"
                                        ><div class="card-body">
                                            <div class="icon-stack icon-stack-xl bg-tertiary-soft text-secondary mb-4 mt-n5 z-1 shadow"><i data-feather="tv"></i></div>
                                            <h5>Läuft alles wie geschmiert?</h5>
                                            <p class="card-text">Der Status Monitor gibt einen Überblick über die technische Gesundheit unserer Systeme und kündigt Wartungsfenster an.</p>
                                        </div>
                                        <div class="card-footer">
                                            <div class="text-teal font-weight-bold d-inline-flex align-items-center">Heartbeat Status Monitor<i class="fas fa-arrow-right text-xs ml-1"></i></div></div
                                    ></a>
                                </div>
                            </div>
                            <div class="row justify-content-center text-center">
                                <div class="col-lg-5 mb-lg-0">
                                    <h5>Join us on Social Media</h5>
                                    <p class="font-weight-light mb-0">Wir freuen uns auch über virtuelle Freundschaften. Folge uns auf LinkedIn und Twitter.</p>
                                </div>
                            </div>
                            <hr class="my-10" />
                            <div class="row justify-content-center">
                                <div class="col-lg-8 text-center">
                                    <h2>Haben wir dein Anliegen noch nicht lösen können?</h2>
                                    <p class="lead mb-5">Kontaktiere uns und wir werden uns schnellstmöglich mit dir in Verbindung setzen. Wir freuen uns auf deine Nachricht.</p>
                                </div>
                            </div><form id="w0" action="/ueber-uns/kontakt-support" method="post">
<input type="hidden" name="_csrf" value="0xklTU3qKTVWrVg1TeS_l1DPuaaiHhXQMErLzJ9VCsW6S2gPAJphfQHBDXc6g_r0Yfzu9O4sJediGvO20ABIpA==">                    <div class="form-group field-model-name required">
<label class="control-label" for="model-name">Name</label>
<input type="text" id="model-name" class="form-control" name="Model[name]" aria-required="true">

<div class="help-block"></div>
</div><div class="form-group field-model-vorname required">
<label class="control-label" for="model-vorname">Vorname</label>
<input type="text" id="model-vorname" class="form-control" name="Model[vorname]" aria-required="true">

<div class="help-block"></div>
</div><div class="form-group field-model-unternehmen required">
<label class="control-label" for="model-unternehmen">Unternehmen / Organisation</label>
<input type="text" id="model-unternehmen" class="form-control" name="Model[unternehmen]" aria-required="true">

<div class="help-block"></div>
</div><div class="form-group field-model-mitteilung required">
<label class="control-label" for="model-mitteilung">Mitteilung / Anfrage</label>
<textarea id="model-mitteilung" class="form-control" name="Model[mitteilung]" aria-required="true"></textarea>
<div class="hint-block">Deine Nachricht / Anfrage an uns</div>
<div class="help-block"></div>
</div>        <button type="submit">Senden</button>    </form>
</form>
                        </div>
                        <div class="svg-border-rounded text-dark">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 144.54 17.34" preserveAspectRatio="none" fill="currentColor"><path d="M144.54,17.34H0V0H144.54ZM0,0S32.36,17.34,72.27,17.34,144.54,0,144.54,0"></path></svg>
                        </div>
                    </section>                    <!-- [CRAWL_IGNORE] -->
                </main>
            </div>
            <div id="layoutDefault_footer">
                <!--
                    dark footer propertie:
                    
                    footer class="footer pt-10 pb-5 mt-auto bg-dark footer-dark">
                -->
                                <footer class="footer pt-5 pb-5 mt-auto bg-dark footer-dark">
                                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-md-6 small">Copyright &copy; Heartbeat GmbH 2020</div>
                            <div class="col-md-6 text-md-right small">
                                                                <a href="https://status.heartbeat.gmbh">Status Page</a>
                                                                    &middot;
                                                                                                <a href="/impressum">Impressum</a>
                                                                                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <!-- [/CRAWL_IGNORE] -->
    <script src="/assets/f69e325b/jquery.js"></script>
<script src="/assets/e067cb19/yii.js"></script>
<script src="/assets/e067cb19/yii.validation.js"></script>
<script src="/assets/e067cb19/yii.activeForm.js"></script>
<script src="//unpkg.com/aos@next/dist/aos.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js"></script>
<script src="//stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/feather-icons/4.24.1/feather.min.js"></script>
<script src="/assets/43734dbd/dist/main.js"></script>
<script>jQuery(function ($) {
jQuery('#w0').yiiActiveForm([{"id":"model-name","name":"name","container":".field-model-name","input":"#model-name","validate":function (attribute, value, messages, deferred, $form) {yii.validation.string(value, messages, {"message":"Name muss eine Zeichenkette sein.","skipOnEmpty":1});yii.validation.required(value, messages, {"message":"Name darf nicht leer sein."});}},{"id":"model-vorname","name":"vorname","container":".field-model-vorname","input":"#model-vorname","validate":function (attribute, value, messages, deferred, $form) {yii.validation.string(value, messages, {"message":"Vorname muss eine Zeichenkette sein.","skipOnEmpty":1});yii.validation.required(value, messages, {"message":"Vorname darf nicht leer sein."});}},{"id":"model-unternehmen","name":"unternehmen","container":".field-model-unternehmen","input":"#model-unternehmen","validate":function (attribute, value, messages, deferred, $form) {yii.validation.string(value, messages, {"message":"Unternehmen / Organisation muss eine Zeichenkette sein.","skipOnEmpty":1});yii.validation.required(value, messages, {"message":"Unternehmen / Organisation darf nicht leer sein."});}},{"id":"model-mitteilung","name":"mitteilung","container":".field-model-mitteilung","input":"#model-mitteilung","validate":function (attribute, value, messages, deferred, $form) {yii.validation.string(value, messages, {"message":"Mitteilung / Anfrage muss eine Zeichenkette sein.","skipOnEmpty":1});yii.validation.required(value, messages, {"message":"Mitteilung / Anfrage darf nicht leer sein."});}}], []);
});</script>    <script>
        AOS.init({
            disable: 'mobile',
            duration: 600,
            once: true
        });
    </script>
    </body>
</html>

EOT;

        

}