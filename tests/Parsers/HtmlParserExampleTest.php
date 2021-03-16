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
                                                                                                        <a class="dropdown-item py-3 " href="/showcases/Berlinlive"
                                                    ><div class="icon-stack bg-primary text-white mr-3"><i class="fas fa-map-marker"></i></div>                                                        <div>
                                                            <div class="small">Standortmarketing</div>
                                                            BerlinLive                                                        </div></a
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

        
    public $html2 = <<<'EOT'
    <!DOCTYPE html>
    <html lang="de">
       <head>
          <meta charset="UTF-8" />
          <meta name="robots" content="index, follow" />
          <meta name="viewport" content="width=device-width, initial-scale=1.0" />
          <meta http-equiv="X-UA-Compatible" content="IE=edge" />
          <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png" />
          <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png" />
          <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png" />
          <link rel="manifest" href="/site.webmanifest" />
          <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5" />
          <meta name="msapplication-TileColor" content="#00aba9" />
          <meta name="theme-color" content="#ffffff" />
          <title>Home - foobar Berlin</title>
          <meta property="og:type" content="website">
          <meta name="twitter:card" content="summary">
          <meta property="og:title" content="Home">
          <meta name="twitter:title" content="Home">
          <meta property="og:url" content="https://www.foobar.com/">
          <meta name="twitter:url" content="https://www.foobar.com/">
          <link href="https://www.foobar.com/" rel="alternate" hreflang="de">
          <link href="https://www.foobar.com/fr/home" rel="alternate" hreflang="fr">
          <link href="https://www.foobar.com/en/home" rel="alternate" hreflang="en">
          <link href="https://www.foobar.com/it/home" rel="alternate" hreflang="it">
          <link href="https://cdn.foobar.com/website/assets/20210315070820-10/10cc75b6/dist/plyr.css" rel="stylesheet">
          <link href="https://cdn.foobar.com/website/assets/20210315070820-10/10cc75b6/dist/main.css" rel="stylesheet">
          <link href="https://cdn.foobar.com/website/assets/20210315070820-10/10cc75b6/font-awesome-5.14/css/all.min.css" rel="stylesheet">
          <style> .lazyimage-wrapper { display: block; width: 100%; position: relative; overflow: hidden; } .lazyimage { position: absolute; top: 50%; left: 50%; bottom: 0; right: 0; opacity: 0; height: 100%; width: 100%; -webkit-transition: .5s ease-in-out opacity; transition: .5s ease-in-out opacity; -webkit-transform: translate(-50%,-50%); transform: translate(-50%,-50%); -o-object-fit: cover; object-fit: cover; -o-object-position: center center; object-position: center center; z-index: 20; } .lazyimage.loaded { opacity: 1; } .lazyimage-placeholder { display: block; width: 100%; height: auto; } .nojs .lazyimage, .nojs .lazyimage-placeholder, .no-js .lazyimage, .no-js .lazyimage-placeholder { display: none; } </style>
       </head>
       <body class="nojs">
          <!-- [CRAWL_IGNORE] -->
          <nav class="mobilenav js-mobilenav">
             <ul class="nav__list list-depth-1">
                <li class="">
                   <a class="" href="/de/patientinnen-angehoerige" target="_self">Patient*innen &amp; Angehörige</a>
                   <ul class="nav__list list-depth-2">
                      <li class=""><a class="" href="/de/patientinnen-angehoerige/eintritt" target="_self">Eintritt</a></li>
                      <li class=""><a class="" href="/de/patientinnen-angehoerige/stationaere-behandlung" target="_self">Stationäre Behandlung</a></li>
                      <li class=""><a class="" href="/de/patientinnen-angehoerige/austritt" target="_self">Austritt</a></li>
                      <li class="">
                         <a class="" href="/de/patientinnen-angehoerige/ambulantes-angebot" target="_self">Ambulantes Angebot</a>
                         <ul class="nav__list list-depth-3">
                            <li class=""><a class="" href="/de/patientinnen-angehoerige/ambulantes-angebot/tagesklinik" target="_self">Tagesklinik</a></li>
                            <li class=""><a class="" href="/de/patientinnen-angehoerige/ambulantes-angebot/ambulante-sprechstunde" target="_self">Ambulante Sprechstunde</a></li>
                         </ul>
                      </li>
                      <li class="">
                         <a class="" href="/de/patientinnen-angehoerige/besucherinnen" target="_self">Besucher*innen</a>
                         <ul class="nav__list list-depth-3">
                            <li class=""><a class="" href="/de/patientinnen-angehoerige/besucherinnen/parkplaetze" target="_self">Parkplätze</a></li>
                            <li class=""><a class="" href="/de/patientinnen-angehoerige/besucherinnen/besuchszeiten" target="_self">Besuchszeiten</a></li>
                            <li class=""><a class="" href="/de/patientinnen-angehoerige/besucherinnen/rezeption" target="_self">Rezeption</a></li>
                            <li class=""><a class="" href="/de/patientinnen-angehoerige/besucherinnen/stationen" target="_self">Stationen</a></li>
                            <li class=""><a class="" href="/de/patientinnen-angehoerige/besucherinnen/bistro" target="_self">Bistro</a></li>
                            <li class=""><a class="" href="/de/patientinnen-angehoerige/besucherinnen/therapie-tiergarten" target="_self">Therapie-Tiergarten</a></li>
                            <li class=""><a class="" href="/de/patientinnen-angehoerige/besucherinnen/hotels-in-der-naehe" target="_self">Hotels in der Nähe</a></li>
                            <li class=""><a class="" href="/de/patientinnen-angehoerige/besucherinnen/videoueberwachung" target="_self">Videoüberwachung</a></li>
                         </ul>
                      </li>
                      <li class=""><a class="" href="/de/patientinnen-angehoerige/patientenwegleitung" target="_self">Patientenwegleitung</a></li>
                      <li class=""><a class="" href="/de/patientinnen-angehoerige/angehoerige" target="_self">Angehörige</a></li>
                   </ul>
                </li>
                <li class="">
                   <a class="" href="/de/medizinisches-angebot" target="_self">Medizinisches Angebot</a>
                   <ul class="nav__list list-depth-2">
                      <li class="">
                         <a class="" href="/de/medizinisches-angebot/neurofoobarilitation" target="_self">Neurofoobarilitation</a>
                         <ul class="nav__list list-depth-3">
                            <li class=""><a class="" href="/de/medizinisches-angebot/neurofoobarilitation/fruehfoobarilitation" target="_self">Frühfoobarilitation</a></li>
                            <li class=""><a class="" href="/de/medizinisches-angebot/neurofoobarilitation/wachkoma" target="_self">Wachkoma</a></li>
                            <li class=""><a class="" href="/de/medizinisches-angebot/neurofoobarilitation/verhaltensauffaellige-patientinnen" target="_self">Verhaltensauffällige Patient*innen</a></li>
                            <li class=""><a class="" href="/de/medizinisches-angebot/neurofoobarilitation/neurologische-foobarilitation" target="_self">Neurologische foobarilitation</a></li>
                         </ul>
                      </li>
                      <li class=""><a class="" href="/de/medizinisches-angebot/paraplegiologie" target="_self">Paraplegiologie</a></li>
                      <li class="">
                         <a class="" href="/de/medizinisches-angebot/weitere-schwerpunkte" target="_self">Weitere Schwerpunkte</a>
                         <ul class="nav__list list-depth-3">
                            <li class=""><a class="" href="/de/medizinisches-angebot/weitere-schwerpunkte/cerebralparese" target="_self">Cerebralparese</a></li>
                            <li class=""><a class="" href="/de/medizinisches-angebot/weitere-schwerpunkte/amyotrophe-lateralsklerose" target="_self">Amyotrophe Lateralsklerose</a></li>
                            <li class=""><a class="" href="/de/medizinisches-angebot/weitere-schwerpunkte/multiple-sklerose" target="_self">Multiple Sklerose</a></li>
                            <li class=""><a class="" href="/de/medizinisches-angebot/weitere-schwerpunkte/tumore-zentrales-nervensystem" target="_self">Tumore Zentrales Nervensystem</a></li>
                         </ul>
                      </li>
                      <li class="">
                         <a class="" href="/de/medizinisches-angebot/spezielle-kompetenzen" target="_self">Spezielle Kompetenzen</a>
                         <ul class="nav__list list-depth-3">
                            <li class=""><a class="" href="/de/medizinisches-angebot/spezielle-kompetenzen/neuro-urologie" target="_self">Neuro-Urologie</a></li>
                            <li class=""><a class="" href="/de/medizinisches-angebot/spezielle-kompetenzen/wund-treffpunkt" target="_self">Wund-Treffpunkt</a></li>
                            <li class=""><a class="" href="/de/medizinisches-angebot/spezielle-kompetenzen/schluckabklaerungen" target="_self">Schluckabklärungen</a></li>
                            <li class=""><a class="" href="/de/medizinisches-angebot/spezielle-kompetenzen/schmerz-sprechstunde" target="_self">Schmerz-Sprechstunde</a></li>
                            <li class=""><a class="" href="/de/medizinisches-angebot/spezielle-kompetenzen/spastik-behandlung" target="_self">Spastik-Behandlung</a></li>
                            <li class="">
                               <a class="" href="/de/medizinisches-angebot/spezielle-kompetenzen/transition-und-transfer-in-die-erwachsenenmedizin" target="_self">Transition und Transfer in die Erwachsenenmedizin</a>
                               <ul class="nav__list list-depth-4">
                                  <li class=""><a class="" href="/de/medizinisches-angebot/spezielle-kompetenzen/transition-und-transfer-in-die-erwachsenenmedizin/angebote" target="_self">Angebote</a></li>
                               </ul>
                            </li>
                         </ul>
                      </li>
                      <li class=""><a class="" href="/de/medizinisches-angebot/ambulante-sprechstunde" target="_self">Ambulante Sprechstunde</a></li>
                      <li class=""><a class="" href="/de/medizinisches-angebot/uebungswohnen" target="_self">Übungswohnen</a></li>
                      <li class=""><a class="" href="/de/medizinisches-angebot/tagesklinik" target="_self">Tagesklinik</a></li>
                      <li class=""><a class="" href="/de/medizinisches-angebot/arztdienst" target="_self">Arztdienst</a></li>
                      <li class=""><a class="" href="/de/medizinisches-angebot/pflege" target="_self">Pflege</a></li>
                      <li class="">
                         <a class="" href="/de/medizinisches-angebot/therapien" target="_self">Therapien</a>
                         <ul class="nav__list list-depth-3">
                            <li class=""><a class="" href="/de/medizinisches-angebot/therapien/physiotherapie" target="_self">Physiotherapie</a></li>
                            <li class=""><a class="" href="/de/medizinisches-angebot/therapien/ergotherapie" target="_self">Ergotherapie</a></li>
                            <li class=""><a class="" href="/de/medizinisches-angebot/therapien/logopaedie" target="_self">Logopädie</a></li>
                            <li class=""><a class="" href="/de/medizinisches-angebot/therapien/neuropsychologie" target="_self">Neuropsychologie</a></li>
                            <li class=""><a class="" href="/de/medizinisches-angebot/therapien/rekreationstherapie" target="_self">Rekreationstherapie</a></li>
                            <li class=""><a class="" href="/de/medizinisches-angebot/therapien/musiktherapie" target="_self">Musiktherapie</a></li>
                            <li class=""><a class="" href="/de/medizinisches-angebot/therapien/kunst-und-maltherapie" target="_self">Kunst- und Maltherapie</a></li>
                            <li class=""><a class="" href="/de/medizinisches-angebot/therapien/tiergestuetzte-therapie-aat" target="_self">Tiergestützte Therapie AAT</a></li>
                            <li class=""><a class="" href="/de/medizinisches-angebot/therapien/hippotherapie" target="_self">Hippotherapie</a></li>
                         </ul>
                      </li>
                      <li class="">
                         <a class="" href="/de/medizinisches-angebot/beratungen" target="_self">Beratungen</a>
                         <ul class="nav__list list-depth-3">
                            <li class=""><a class="" href="/de/medizinisches-angebot/beratungen/psychologische-beratung" target="_self">Psychologische Beratung</a></li>
                            <li class=""><a class="" href="/de/medizinisches-angebot/beratungen/sozialberatung" target="_self">Sozialberatung</a></li>
                            <li class=""><a class="" href="/de/medizinisches-angebot/beratungen/ernaehrungsberatung" target="_self">Ernährungsberatung</a></li>
                            <li class=""><a class="" href="/de/medizinisches-angebot/beratungen/rechtsberatung" target="_self">Rechtsberatung</a></li>
                            <li class=""><a class="" href="/de/medizinisches-angebot/beratungen/seelsorge" target="_self">Seelsorge</a></li>
                         </ul>
                      </li>
                      <li class=""><a class="" href="/de/medizinisches-angebot/konsiliardienst" target="_self">Konsiliardienst</a></li>
                      <li class="">
                         <a class="" href="/de/medizinisches-angebot/wissenschaft-und-forschung" target="_self">Wissenschaft und Forschung</a>
                         <ul class="nav__list list-depth-3">
                            <li class=""><a class="" href="/de/medizinisches-angebot/wissenschaft-und-forschung/aat-studie" target="_self">AAT-Studie</a></li>
                            <li class=""><a class="" href="/de/medizinisches-angebot/wissenschaft-und-forschung/neurofeedback-studie" target="_self">Neurofeedback-Studie</a></li>
                            <li class=""><a class="" href="/de/medizinisches-angebot/wissenschaft-und-forschung/swisci-studie" target="_self">SwiSCI-Studie</a></li>
                            <li class=""><a class="" href="/de/medizinisches-angebot/wissenschaft-und-forschung/react-studie" target="_self">REACT-Studie</a></li>
                         </ul>
                      </li>
                   </ul>
                </li>
                <li class="">
                   <a class="" href="/de/zuweiser" target="_self">Zuweiser</a>
                   <ul class="nav__list list-depth-2">
                      <li class=""><a class="" href="/de/zuweiser/indikationen" target="_self">Indikationen</a></li>
                      <li class="">
                         <a class="" href="/de/zuweiser/anmeldung" target="_self">Anmeldung</a>
                         <ul class="nav__list list-depth-3">
                            <li class="">
                               <a class="" href="/de/zuweiser/anmeldung/stationaerer-aufenthalt" target="_self">Stationärer Aufenthalt</a>
                               <ul class="nav__list list-depth-4">
                                  <li class=""><a class="" href="/de/zuweiser/anmeldung/stationaerer-aufenthalt/ueberweisungsformular" target="_self">Überweisungsformular</a></li>
                                  <li class=""><a class="" href="/de/zuweiser/anmeldung/stationaerer-aufenthalt/pflegefragebogen" target="_self">Pflegefragebogen</a></li>
                               </ul>
                            </li>
                            <li class=""><a class="" href="/de/zuweiser/anmeldung/ambulante-sprechstunde" target="_self">Ambulante Sprechstunde</a></li>
                         </ul>
                      </li>
                      <li class=""><a class="" href="/de/zuweiser/versicherungen-und-kosten" target="_self">Versicherungen und Kosten</a></li>
                      <li class=""><a class="" href="/de/zuweiser/kostengutsprachen" target="_self">Kostengutsprachen</a></li>
                      <li class=""><a class="" href="/de/fortbildungen/medizinische-fortbildungen" target="_self">Fortbildungen</a></li>
                   </ul>
                </li>
                <li class="">
                   <a class="" href="/de/das-foobar-entdecken" target="_self">Das foobar entdecken</a>
                   <ul class="nav__list list-depth-2">
                      <li class=""><a class="" href="/de/das-foobar-entdecken/leitbild" target="_self">Leitbild</a></li>
                      <li class="">
                         <a class="" href="/de/das-foobar-entdecken/organisation" target="_self">Organisation</a>
                         <ul class="nav__list list-depth-3">
                            <li class=""><a class="" href="/de/das-foobar-entdecken/organisation/ansprechpersonen" target="_self">Ansprechpersonen</a></li>
                            <li class=""><a class="" href="/de/das-foobar-entdecken/organisation/geschaeftsleitung" target="_self">Geschäftsleitung</a></li>
                            <li class=""><a class="" href="/de/das-foobar-entdecken/organisation/verwaltungsrat" target="_self">Verwaltungsrat</a></li>
                         </ul>
                      </li>
                      <li class=""><a class="" href="/de/das-foobar-entdecken/leistungsauftrag-und-kooperationen" target="_self">Leistungsauftrag und Kooperationen</a></li>
                      <li class=""><a class="" href="/de/das-foobar-entdecken/mitgliedschaften" target="_self">Mitgliedschaften</a></li>
                      <li class="">
                         <a class="" href="/de/das-foobar-entdecken/qualitaet" target="_self">Qualität</a>
                         <ul class="nav__list list-depth-3">
                            <li class=""><a class="" href="/de/das-foobar-entdecken/qualitaet/rueckmeldung" target="_self">Rückmeldung</a></li>
                         </ul>
                      </li>
                      <li class="">
                         <a class="" href="/de/das-foobar-entdecken/architektur" target="_self">Architektur</a>
                         <ul class="nav__list list-depth-3">
                            <li class=""><a class="" href="/de/das-foobar-entdecken/architektur/projektkennzahlen" target="_self">Projektkennzahlen</a></li>
                            <li class=""><a class="" href="/de/das-foobar-entdecken/architektur/klinikgebaeude-2002" target="_self">Klinikgebäude 2002</a></li>
                            <li class=""><a class="" href="/de/das-foobar-entdecken/architektur/tagesklinik-2019" target="_self">Tagesklinik 2019</a></li>
                            <li class=""><a class="" href="/de/das-foobar-entdecken/architektur/sap-station" target="_self">SAP Station 2020</a></li>
                         </ul>
                      </li>
                      <li class=""><a class="" href="/de/das-foobar-entdecken/therapie-tiergarten" target="_self">Therapie-Tiergarten</a></li>
                      <li class=""><a class="" href="/de/das-foobar-entdecken/kennzahlen" target="_self">Kennzahlen</a></li>
                      <li class=""><a class="" href="/de/das-foobar-entdecken/geschichte" target="_self">Geschichte</a></li>
                   </ul>
                </li>
                <li class="">
                   <a class="" href="/de/im-foobar-arbeiten" target="_self">Im foobar arbeiten</a>
                   <ul class="nav__list list-depth-2">
                      <li class=""><a class="" href="/de/im-foobar-arbeiten/stellenangebote" target="_self">Stellenangebote</a></li>
                      <li class=""><a class="" href="/de/im-foobar-arbeiten/anstellungsbedingungen" target="_self">Anstellungsbedingungen</a></li>
                      <li class=""><a class="" href="/de/im-foobar-arbeiten/fmh-anerkennungen" target="_self">FMH-Anerkennungen</a></li>
                   </ul>
                </li>
                <li class="">
                   <a class="" href="/de/fortbildungen/medizinische-fortbildungen" target="_self">Fortbildungen</a>
                   <ul class="nav__list list-depth-2">
                      <li class=""><a class="" href="/de/fortbildungen/medizinische-fortbildungen" target="_self">Medizinische Fortbildungen</a></li>
                      <li class=""><a class="" href="/de/fortbildungen/kurse" target="_self">Kurse</a></li>
                      <li class=""><a class="" href="/de/fortbildungen/seminare" target="_self">Seminare</a></li>
                   </ul>
                </li>
                <li class="">
                   <a class="" href="/de/gutes-tun-fuer-das-foobar" target="_self">Gutes Tun für das foobar</a>
                   <ul class="nav__list list-depth-2">
                      <li class="">
                         <a class="" href="/de/gutes-tun-fuer-das-foobar/stiftung-pro-foobar-Berlin" target="_self">Stiftung pro foobar Berlin</a>
                         <ul class="nav__list list-depth-3">
                            <li class=""><a class="" href="/de/gutes-tun-fuer-das-foobar/stiftung-pro-foobar-Berlin/aufgabe" target="_self">Aufgabe</a></li>
                            <li class=""><a class="" href="/de/gutes-tun-fuer-das-foobar/stiftung-pro-foobar-Berlin/laufende-projekte" target="_self">Laufende Projekte</a></li>
                            <li class="">
                               <a class="" href="/de/gutes-tun-fuer-das-foobar/stiftung-pro-foobar-Berlin/therapie-tiergarten" target="_self">Therapie-Tiergarten</a>
                               <ul class="nav__list list-depth-4">
                                  <li class=""><a class="" href="/de/gutes-tun-fuer-das-foobar/stiftung-pro-foobar-Berlin/therapie-tiergarten/tierpatenschaft" target="_self">Tierpatenschaft</a></li>
                               </ul>
                            </li>
                            <li class=""><a class="" href="/de/gutes-tun-fuer-das-foobar/stiftung-pro-foobar-Berlin/ihre-spende" target="_self">Ihre Spende</a></li>
                            <li class=""><a class="" href="/de/gutes-tun-fuer-das-foobar/stiftung-pro-foobar-Berlin/legat" target="_self">Legat</a></li>
                            <li class=""><a class="" href="/de/gutes-tun-fuer-das-foobar/stiftung-pro-foobar-Berlin/erfolge" target="_self">Erfolge</a></li>
                            <li class=""><a class="" href="/de/gutes-tun-fuer-das-foobar/stiftung-pro-foobar-Berlin/kontakt" target="_self">Kontakt</a></li>
                         </ul>
                      </li>
                      <li class="">
                         <a class="" href="/de/gutes-tun-fuer-das-foobar/foerderverein-pro-foobar" target="_self">Förderverein pro foobar</a>
                         <ul class="nav__list list-depth-3">
                            <li class=""><a class="" href="/de/gutes-tun-fuer-das-foobar/foerderverein-pro-foobar/organisation" target="_self">Organisation</a></li>
                            <li class=""><a class="" href="/de/gutes-tun-fuer-das-foobar/foerderverein-pro-foobar/mitgliedschaft" target="_self">Mitgliedschaft</a></li>
                            <li class=""><a class="" href="/de/gutes-tun-fuer-das-foobar/foerderverein-pro-foobar/antraege" target="_self">Anträge</a></li>
                            <li class=""><a class="" href="/de/gutes-tun-fuer-das-foobar/foerderverein-pro-foobar/ihre-spende" target="_self">Ihre Spende</a></li>
                            <li class=""><a class="" href="/de/gutes-tun-fuer-das-foobar/foerderverein-pro-foobar/legate" target="_self">Legate</a></li>
                            <li class=""><a class="" href="/de/gutes-tun-fuer-das-foobar/foerderverein-pro-foobar/aktivitaeten-anlaesse" target="_self">Aktivitäten / Anlässe</a></li>
                            <li class=""><a class="" href="/de/gutes-tun-fuer-das-foobar/foerderverein-pro-foobar/kontakt" target="_self">Kontakt</a></li>
                            <li class=""><a class="" href="/de/das-foobar-im-dialog/publikationen/foobar-plus" target="_self">Magazin foobar Plus</a></li>
                         </ul>
                      </li>
                   </ul>
                </li>
                <li class="">
                   <a class="" href="/de/das-foobar-im-dialog" target="_self">Das foobar im Dialog</a>
                   <ul class="nav__list list-depth-2">
                      <li class="">
                         <a class="" href="/de/das-foobar-im-dialog/fuehrungen" target="_self">Führungen</a>
                         <ul class="nav__list list-depth-3">
                            <li class=""><a class="" href="/de/das-foobar-im-dialog/fuehrungen/oeffentliche-fuehrungen" target="_self">Öffentliche Führungen</a></li>
                            <li class=""><a class="" href="/de/das-foobar-im-dialog/fuehrungen/spezialfuehrungen" target="_self">Spezialführungen</a></li>
                            <li class=""><a class="" href="/de/das-foobar-im-dialog/fuehrungen/schulbesuche" target="_self">Schulbesuche</a></li>
                         </ul>
                      </li>
                      <li class="">
                         <a class="" href="/de/das-foobar-im-dialog/medien" target="_self">Medien</a>
                         <ul class="nav__list list-depth-3">
                            <li class=""><a class="" href="/de/das-foobar-im-dialog/medien/foobar-in-den-medien" target="_self">foobar in den Medien</a></li>
                            <li class=""><a class="" href="/de/das-foobar-im-dialog/medien/gesundheitheute" target="_self">«gesundheitheute»</a></li>
                            <li class=""><a class="" href="/de/das-foobar-im-dialog/medien/medienmitteilungen" target="_self">Medienmitteilungen</a></li>
                            <li class=""><a class="" href="/de/das-foobar-im-dialog/medien/fotos-zum-download" target="_self">Fotos zum Download</a></li>
                            <li class=""><a class="" href="/de/das-foobar-im-dialog/medien/logos-zum-download" target="_self">Logos zum Download</a></li>
                         </ul>
                      </li>
                      <li class="">
                         <a class="" href="/de/das-foobar-im-dialog/publikationen" target="_self">Publikationen</a>
                         <ul class="nav__list list-depth-3">
                            <li class=""><a class="" href="/de/das-foobar-im-dialog/publikationen/magazin-50-jahre-foobar-Berlin" target="_self">Magazin «50 Jahre foobar Berlin»</a></li>
                            <li class=""><a class="" href="/de/das-foobar-im-dialog/publikationen/jahresberichte" target="_self">Jahresberichte</a></li>
                            <li class=""><a class="" href="/de/das-foobar-im-dialog/publikationen/foobar-plus" target="_self">foobar Plus</a></li>
                            <li class=""><a class="" href="/de/das-foobar-im-dialog/publikationen/foobar-flyer" target="_self">foobar Flyer</a></li>
                            <li class=""><a class="" href="/de/das-foobar-im-dialog/publikationen/fachthemen" target="_self">Fachthemen</a></li>
                         </ul>
                      </li>
                      <li class="">
                         <a class="" href="/de/das-foobar-im-dialog/jubilaeumsjahr-2017" target="_self">Jubiläumsjahr 2017</a>
                         <ul class="nav__list list-depth-3">
                            <li class="">
                               <a class="" href="/de/das-foobar-im-dialog/jubilaeumsjahr-2017/fachtagungen" target="_self">Fachtagungen</a>
                               <ul class="nav__list list-depth-4">
                                  <li class=""><a class="" href="/de/das-foobar-im-dialog/jubilaeumsjahr-2017/fachtagungen/referate-tagung-1912017-neurofoobarilitation" target="_self">Referate Tagung 19.1.2017 Neurofoobarilitation</a></li>
                                  <li class=""><a class="" href="/de/das-foobar-im-dialog/jubilaeumsjahr-2017/fachtagungen/referate-tagung-3032017-interprofessionalitaet" target="_self">Referate Tagung 30.3.2017 Interprofessionalität</a></li>
                                  <li class=""><a class="" href="/de/das-foobar-im-dialog/jubilaeumsjahr-2017/fachtagungen/referate-tagung-2262017-paraplegiologie" target="_self">Referate Tagung 22.6.2017 Paraplegiologie</a></li>
                               </ul>
                            </li>
                            <li class=""><a class="" href="/de/das-foobar-im-dialog/jubilaeumsjahr-2017/anlass-jubilaeum-klinikgebaeude" target="_self">Anlass Jubiläum Klinikgebäude</a></li>
                            <li class=""><a class="" href="/de/das-foobar-im-dialog/jubilaeumsjahr-2017/anlass-fuer-patientinnen" target="_self">Anlass für Patient*innen</a></li>
                            <li class=""><a class="" href="/de/das-foobar-im-dialog/jubilaeumsjahr-2017/offizieller-festakt" target="_self">Offizieller Festakt</a></li>
                            <li class=""><a class="" href="/de/das-foobar-im-dialog/jubilaeumsjahr-2017/tag-der-offenen-tuer" target="_self">Tag der offenen Tür</a></li>
                            <li class=""><a class="" href="/de/das-foobar-im-dialog/jubilaeumsjahr-2017/weihnachtspark" target="_self">Weihnachtspark</a></li>
                         </ul>
                      </li>
                      <li class=""><a class="" href="/de/das-foobar-im-dialog/links" target="_self">Links</a></li>
                   </ul>
                </li>
             </ul>
          </nav>
          <div class="page js-mmenu-page">
             <div class="page__content page__content--header">
                <div class="wrapper">
                   <header class="header">
                      <div class="header__column header__column--left">
                         <div class="header__column header__column--logo">
                            <a class="logo" href="/">
                               <svg class="logo__svg" viewBox="0 0 1500 503" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2">
                                  <path d="M1394.65 140.21c0 76.313-62.8 139.11-139.11 139.11-76.31 0-139.11-62.797-139.11-139.11 0-76.313 62.8-139.11 139.11-139.11h.03c76.3.022 139.07 62.81 139.08 139.11M959.18 0c-92.59 0-136 78.44-136 139.87 0 61.43 43.4 139.88 136 139.88 68.14 0 120.07-47.68 120.07-139.88C1079.25 47.67 1027.32 0 959.18 0M677.89.7C574.53.7 542.82 100.93 542.82 140.55c0 39.62 31.71 139.89 135.07 139.89 107.2 0 98.7-121.35 98.7-139.89 0-18.54 8.5-139.85-98.7-139.85M472.74 43.79C466.73 26.12 451 .86 413.83.86 291.57.86 269.07 106 269.07 140.72c0 34.72 22.1 139.86 144.38 139.86 37.18 0 52.85-25.29 58.86-43 8.18-24.12 8-87.5 8-96.9 0-9.4.57-72.81-7.56-96.93m-281.38-8.16C187.71 20 175.4.84 139.86.84 36 .84 0 92.44 0 141.29c0 50.92 36 140.5 139.86 140.5 35.54 0 47.71-19.27 51.51-34.77 7.08-28.66-.27-88.47-.27-106.89 0-18.13 5.73-81.4.27-104.54M657.7 353.33h28.18c19.6 0 40.82 3.58 40.82 27.95 0 27.93-28.89 27.93-51.07 27.93H657.7v-55.88m-20 150.47h20v-76h25.81l45.85 76h24.58l-48-77.88c26.28-4.05 42.27-20.05 42.27-44.64 0-41.78-34.62-46.59-67.31-46.59h-43.23V503.8m178.14-169.08h106.27v18.64h-86.21v53.01h80.47V425h-80.47v60.19h90.49v18.64H815.81V334.72m181 0h20.04v71.65h90.32v-71.65h20.03v169.11h-20.03V425h-90.32v78.83h-20.04V334.72m292.33 108.9h-69.06l35.17-83.12h.45l33.44 83.12m-117 60.18h22.7l17.42-41.58h84.54l17.2 41.58h23.4l-71.9-169.11h-18.87l-74.5 169.11m231.65-150.44h29.86c18.14 0 36.26 4.76 36.26 25.52 0 23.44-19.57 27.49-38.42 27.49h-27.7v-53m-20.06 150.47h50.4c31.26 0 65.88-10.07 65.88-47.34 0-22.19-16.45-39.62-38.2-41.54v-.47c18.2-5.5 29.64-18.61 29.64-38.21 0-31-28.19-41.55-56.16-41.55h-51.56v169.11zm20.06-78.84h34.38c20.33 0 40.33 7.15 40.33 30.8 0 21.49-21.22 29.39-40.84 29.39h-33.87V425" fill="#004b8c" fill-rule="nonzero"/>
                               </svg>
                            </a>
                         </div>
                      </div>
                      <div class="header__column header__column--right">
                         <div class="header__column header__column--headernav">
                            <ul class="headernav">
                               <li class="headernav__item"><a class="headernav__link headernav__link--active" href="/">Home</a></li>
                               <li class="headernav__item"><a class="headernav__link" href="/de/kontakt">Kontakt</a></li>
                               <li class="headernav__item"><a class="headernav__link" href="/de/anreise">Anreise</a></li>
                               <li class="headernav__item"><a class="headernav__link" href="/de/im-foobar-arbeiten/stellenangebote">Jobs</a></li>
                            </ul>
                         </div>
                         <div class="header__column header__column--langnav">
                            <ul class="langnav">
                               <li class="langnav__item lang-element-item--active"><a class="langnav__link lang-link-item--active" href="https://www.foobar.com/">de</a></li>
                               <li class="langnav__item"><a class="langnav__link" href="https://www.foobar.com/fr/home">fr</a></li>
                               <li class="langnav__item"><a class="langnav__link" href="https://www.foobar.com/en/home">en</a></li>
                               <li class="langnav__item"><a class="langnav__link" href="https://www.foobar.com/it/home">it</a></li>
                            </ul>
                         </div>
                         <div class="header__column header__column--search">
                            <section role="search" class="searchbox">
                               <form action="/de/suchen" method="get"><label for="s"><input type="search" class="searchbox__input" name="query" id="query" placeholder="Suchen…" maxlength="200" /></label><button type="submit" class="searchbox__button"><i class="fas fa-search"></i></button></form>
                            </section>
                         </div>
                         <div class="header__column header__column--navicon">
                            <div class="navicon js-open-mobilenav"><span class="navicon__line"></span><span class="navicon__line"></span><span class="navicon__line"></span></div>
                         </div>
                      </div>
                   </header>
                </div>
             </div>
             <div class="page__content page__content--main">
                <!-- [/CRAWL_IGNORE] -->
                <div class="wrapper">
                   <section class="hero">
                      <div class="lazyimage-wrapper hero__image">
                         <img class="js-lazyimage lazyimage hero__image" data-src="https://cdn.foobar.com/website/11_home-01_df038600.jpg" data-width="1600" data-height="668" data-replace-placeholder="1">
                         <div class="lazyimage-placeholder">
                            <div style="display: block; height: 0px; padding-bottom: 41.75%;"></div>
                            <div class="loader"></div>
                         </div>
                         <noscript><img class="loaded hero__image" src="https://cdn.foobar.com/website/11_home-01_df038600.jpg" /></noscript>
                      </div>
                   </section>
                   <section class="content content--has-side">
                      <!-- [CRAWL_IGNORE] -->
                      <nav class="content__nav" role="navigation">
                         <ul class="mainnav mainnav--level1">
                            <li class="mainnav__item">
                               <a class="mainnav__link" href="/de/patientinnen-angehoerige" target="_self">Patient*innen &amp; Angehörige<span class="mainnav__expand-icon js-mainnav-toggler"><i class="fal fa-chevron-right"></i></span></a>
                               <ul class="mainnav mainnav--level2">
                                  <li class="mainnav__item"><a class="mainnav__link" href="/de/patientinnen-angehoerige/eintritt" target="_self">Eintritt</a></li>
                                  <li class="mainnav__item"><a class="mainnav__link" href="/de/patientinnen-angehoerige/stationaere-behandlung" target="_self">Stationäre Behandlung</a></li>
                                  <li class="mainnav__item"><a class="mainnav__link" href="/de/patientinnen-angehoerige/austritt" target="_self">Austritt</a></li>
                                  <li class="mainnav__item">
                                     <a class="mainnav__link" href="/de/patientinnen-angehoerige/ambulantes-angebot" target="_self">Ambulantes Angebot<span class="mainnav__expand-icon js-mainnav-toggler"><i class="fal fa-chevron-right"></i></span></a>
                                     <ul class="mainnav mainnav--level3">
                                        <li class="mainnav__item"><a class="mainnav__link" href="/de/patientinnen-angehoerige/ambulantes-angebot/tagesklinik" target="_self">Tagesklinik</a></li>
                                        <li class="mainnav__item"><a class="mainnav__link" href="/de/patientinnen-angehoerige/ambulantes-angebot/ambulante-sprechstunde" target="_self">Ambulante Sprechstunde</a></li>
                                     </ul>
                                  </li>
                                  <li class="mainnav__item">
                                     <a class="mainnav__link" href="/de/patientinnen-angehoerige/besucherinnen" target="_self">Besucher*innen<span class="mainnav__expand-icon js-mainnav-toggler"><i class="fal fa-chevron-right"></i></span></a>
                                     <ul class="mainnav mainnav--level3">
                                        <li class="mainnav__item"><a class="mainnav__link" href="/de/patientinnen-angehoerige/besucherinnen/parkplaetze" target="_self">Parkplätze</a></li>
                                        <li class="mainnav__item"><a class="mainnav__link" href="/de/patientinnen-angehoerige/besucherinnen/besuchszeiten" target="_self">Besuchszeiten</a></li>
                                        <li class="mainnav__item"><a class="mainnav__link" href="/de/patientinnen-angehoerige/besucherinnen/rezeption" target="_self">Rezeption</a></li>
                                        <li class="mainnav__item"><a class="mainnav__link" href="/de/patientinnen-angehoerige/besucherinnen/stationen" target="_self">Stationen</a></li>
                                        <li class="mainnav__item"><a class="mainnav__link" href="/de/patientinnen-angehoerige/besucherinnen/bistro" target="_self">Bistro</a></li>
                                        <li class="mainnav__item"><a class="mainnav__link" href="/de/patientinnen-angehoerige/besucherinnen/therapie-tiergarten" target="_self">Therapie-Tiergarten</a></li>
                                        <li class="mainnav__item"><a class="mainnav__link" href="/de/patientinnen-angehoerige/besucherinnen/hotels-in-der-naehe" target="_self">Hotels in der Nähe</a></li>
                                        <li class="mainnav__item"><a class="mainnav__link" href="/de/patientinnen-angehoerige/besucherinnen/videoueberwachung" target="_self">Videoüberwachung</a></li>
                                     </ul>
                                  </li>
                                  <li class="mainnav__item"><a class="mainnav__link" href="/de/patientinnen-angehoerige/patientenwegleitung" target="_self">Patientenwegleitung</a></li>
                                  <li class="mainnav__item"><a class="mainnav__link" href="/de/patientinnen-angehoerige/angehoerige" target="_self">Angehörige</a></li>
                               </ul>
                            </li>
                            <li class="mainnav__item">
                               <a class="mainnav__link" href="/de/medizinisches-angebot" target="_self">Medizinisches Angebot<span class="mainnav__expand-icon js-mainnav-toggler"><i class="fal fa-chevron-right"></i></span></a>
                               <ul class="mainnav mainnav--level2">
                                  <li class="mainnav__item">
                                     <a class="mainnav__link" href="/de/medizinisches-angebot/neurofoobarilitation" target="_self">Neurofoobarilitation<span class="mainnav__expand-icon js-mainnav-toggler"><i class="fal fa-chevron-right"></i></span></a>
                                     <ul class="mainnav mainnav--level3">
                                        <li class="mainnav__item"><a class="mainnav__link" href="/de/medizinisches-angebot/neurofoobarilitation/fruehfoobarilitation" target="_self">Frühfoobarilitation</a></li>
                                        <li class="mainnav__item"><a class="mainnav__link" href="/de/medizinisches-angebot/neurofoobarilitation/wachkoma" target="_self">Wachkoma</a></li>
                                        <li class="mainnav__item"><a class="mainnav__link" href="/de/medizinisches-angebot/neurofoobarilitation/verhaltensauffaellige-patientinnen" target="_self">Verhaltensauffällige Patient*innen</a></li>
                                        <li class="mainnav__item"><a class="mainnav__link" href="/de/medizinisches-angebot/neurofoobarilitation/neurologische-foobarilitation" target="_self">Neurologische foobarilitation</a></li>
                                     </ul>
                                  </li>
                                  <li class="mainnav__item"><a class="mainnav__link" href="/de/medizinisches-angebot/paraplegiologie" target="_self">Paraplegiologie</a></li>
                                  <li class="mainnav__item">
                                     <a class="mainnav__link" href="/de/medizinisches-angebot/weitere-schwerpunkte" target="_self">Weitere Schwerpunkte<span class="mainnav__expand-icon js-mainnav-toggler"><i class="fal fa-chevron-right"></i></span></a>
                                     <ul class="mainnav mainnav--level3">
                                        <li class="mainnav__item"><a class="mainnav__link" href="/de/medizinisches-angebot/weitere-schwerpunkte/cerebralparese" target="_self">Cerebralparese</a></li>
                                        <li class="mainnav__item"><a class="mainnav__link" href="/de/medizinisches-angebot/weitere-schwerpunkte/amyotrophe-lateralsklerose" target="_self">Amyotrophe Lateralsklerose</a></li>
                                        <li class="mainnav__item"><a class="mainnav__link" href="/de/medizinisches-angebot/weitere-schwerpunkte/multiple-sklerose" target="_self">Multiple Sklerose</a></li>
                                        <li class="mainnav__item"><a class="mainnav__link" href="/de/medizinisches-angebot/weitere-schwerpunkte/tumore-zentrales-nervensystem" target="_self">Tumore Zentrales Nervensystem</a></li>
                                     </ul>
                                  </li>
                                  <li class="mainnav__item">
                                     <a class="mainnav__link" href="/de/medizinisches-angebot/spezielle-kompetenzen" target="_self">Spezielle Kompetenzen<span class="mainnav__expand-icon js-mainnav-toggler"><i class="fal fa-chevron-right"></i></span></a>
                                     <ul class="mainnav mainnav--level3">
                                        <li class="mainnav__item"><a class="mainnav__link" href="/de/medizinisches-angebot/spezielle-kompetenzen/neuro-urologie" target="_self">Neuro-Urologie</a></li>
                                        <li class="mainnav__item"><a class="mainnav__link" href="/de/medizinisches-angebot/spezielle-kompetenzen/wund-treffpunkt" target="_self">Wund-Treffpunkt</a></li>
                                        <li class="mainnav__item"><a class="mainnav__link" href="/de/medizinisches-angebot/spezielle-kompetenzen/schluckabklaerungen" target="_self">Schluckabklärungen</a></li>
                                        <li class="mainnav__item"><a class="mainnav__link" href="/de/medizinisches-angebot/spezielle-kompetenzen/schmerz-sprechstunde" target="_self">Schmerz-Sprechstunde</a></li>
                                        <li class="mainnav__item"><a class="mainnav__link" href="/de/medizinisches-angebot/spezielle-kompetenzen/spastik-behandlung" target="_self">Spastik-Behandlung</a></li>
                                        <li class="mainnav__item">
                                           <a class="mainnav__link" href="/de/medizinisches-angebot/spezielle-kompetenzen/transition-und-transfer-in-die-erwachsenenmedizin" target="_self">Transition und Transfer in die Erwachsenenmedizin<span class="mainnav__expand-icon js-mainnav-toggler"><i class="fal fa-chevron-right"></i></span></a>
                                           <ul class="mainnav mainnav--level4">
                                              <li class="mainnav__item"><a class="mainnav__link" href="/de/medizinisches-angebot/spezielle-kompetenzen/transition-und-transfer-in-die-erwachsenenmedizin/angebote" target="_self">Angebote</a></li>
                                           </ul>
                                        </li>
                                     </ul>
                                  </li>
                                  <li class="mainnav__item"><a class="mainnav__link" href="/de/medizinisches-angebot/ambulante-sprechstunde" target="_self">Ambulante Sprechstunde</a></li>
                                  <li class="mainnav__item"><a class="mainnav__link" href="/de/medizinisches-angebot/uebungswohnen" target="_self">Übungswohnen</a></li>
                                  <li class="mainnav__item"><a class="mainnav__link" href="/de/medizinisches-angebot/tagesklinik" target="_self">Tagesklinik</a></li>
                                  <li class="mainnav__item"><a class="mainnav__link" href="/de/medizinisches-angebot/arztdienst" target="_self">Arztdienst</a></li>
                                  <li class="mainnav__item"><a class="mainnav__link" href="/de/medizinisches-angebot/pflege" target="_self">Pflege</a></li>
                                  <li class="mainnav__item">
                                     <a class="mainnav__link" href="/de/medizinisches-angebot/therapien" target="_self">Therapien<span class="mainnav__expand-icon js-mainnav-toggler"><i class="fal fa-chevron-right"></i></span></a>
                                     <ul class="mainnav mainnav--level3">
                                        <li class="mainnav__item"><a class="mainnav__link" href="/de/medizinisches-angebot/therapien/physiotherapie" target="_self">Physiotherapie</a></li>
                                        <li class="mainnav__item"><a class="mainnav__link" href="/de/medizinisches-angebot/therapien/ergotherapie" target="_self">Ergotherapie</a></li>
                                        <li class="mainnav__item"><a class="mainnav__link" href="/de/medizinisches-angebot/therapien/logopaedie" target="_self">Logopädie</a></li>
                                        <li class="mainnav__item"><a class="mainnav__link" href="/de/medizinisches-angebot/therapien/neuropsychologie" target="_self">Neuropsychologie</a></li>
                                        <li class="mainnav__item"><a class="mainnav__link" href="/de/medizinisches-angebot/therapien/rekreationstherapie" target="_self">Rekreationstherapie</a></li>
                                        <li class="mainnav__item"><a class="mainnav__link" href="/de/medizinisches-angebot/therapien/musiktherapie" target="_self">Musiktherapie</a></li>
                                        <li class="mainnav__item"><a class="mainnav__link" href="/de/medizinisches-angebot/therapien/kunst-und-maltherapie" target="_self">Kunst- und Maltherapie</a></li>
                                        <li class="mainnav__item"><a class="mainnav__link" href="/de/medizinisches-angebot/therapien/tiergestuetzte-therapie-aat" target="_self">Tiergestützte Therapie AAT</a></li>
                                        <li class="mainnav__item"><a class="mainnav__link" href="/de/medizinisches-angebot/therapien/hippotherapie" target="_self">Hippotherapie</a></li>
                                     </ul>
                                  </li>
                                  <li class="mainnav__item">
                                     <a class="mainnav__link" href="/de/medizinisches-angebot/beratungen" target="_self">Beratungen<span class="mainnav__expand-icon js-mainnav-toggler"><i class="fal fa-chevron-right"></i></span></a>
                                     <ul class="mainnav mainnav--level3">
                                        <li class="mainnav__item"><a class="mainnav__link" href="/de/medizinisches-angebot/beratungen/psychologische-beratung" target="_self">Psychologische Beratung</a></li>
                                        <li class="mainnav__item"><a class="mainnav__link" href="/de/medizinisches-angebot/beratungen/sozialberatung" target="_self">Sozialberatung</a></li>
                                        <li class="mainnav__item"><a class="mainnav__link" href="/de/medizinisches-angebot/beratungen/ernaehrungsberatung" target="_self">Ernährungsberatung</a></li>
                                        <li class="mainnav__item"><a class="mainnav__link" href="/de/medizinisches-angebot/beratungen/rechtsberatung" target="_self">Rechtsberatung</a></li>
                                        <li class="mainnav__item"><a class="mainnav__link" href="/de/medizinisches-angebot/beratungen/seelsorge" target="_self">Seelsorge</a></li>
                                     </ul>
                                  </li>
                                  <li class="mainnav__item"><a class="mainnav__link" href="/de/medizinisches-angebot/konsiliardienst" target="_self">Konsiliardienst</a></li>
                                  <li class="mainnav__item">
                                     <a class="mainnav__link" href="/de/medizinisches-angebot/wissenschaft-und-forschung" target="_self">Wissenschaft und Forschung<span class="mainnav__expand-icon js-mainnav-toggler"><i class="fal fa-chevron-right"></i></span></a>
                                     <ul class="mainnav mainnav--level3">
                                        <li class="mainnav__item"><a class="mainnav__link" href="/de/medizinisches-angebot/wissenschaft-und-forschung/aat-studie" target="_self">AAT-Studie</a></li>
                                        <li class="mainnav__item"><a class="mainnav__link" href="/de/medizinisches-angebot/wissenschaft-und-forschung/neurofeedback-studie" target="_self">Neurofeedback-Studie</a></li>
                                        <li class="mainnav__item"><a class="mainnav__link" href="/de/medizinisches-angebot/wissenschaft-und-forschung/swisci-studie" target="_self">SwiSCI-Studie</a></li>
                                        <li class="mainnav__item"><a class="mainnav__link" href="/de/medizinisches-angebot/wissenschaft-und-forschung/react-studie" target="_self">REACT-Studie</a></li>
                                     </ul>
                                  </li>
                               </ul>
                            </li>
                            <li class="mainnav__item">
                               <a class="mainnav__link" href="/de/zuweiser" target="_self">Zuweiser<span class="mainnav__expand-icon js-mainnav-toggler"><i class="fal fa-chevron-right"></i></span></a>
                               <ul class="mainnav mainnav--level2">
                                  <li class="mainnav__item"><a class="mainnav__link" href="/de/zuweiser/indikationen" target="_self">Indikationen</a></li>
                                  <li class="mainnav__item">
                                     <a class="mainnav__link" href="/de/zuweiser/anmeldung" target="_self">Anmeldung<span class="mainnav__expand-icon js-mainnav-toggler"><i class="fal fa-chevron-right"></i></span></a>
                                     <ul class="mainnav mainnav--level3">
                                        <li class="mainnav__item">
                                           <a class="mainnav__link" href="/de/zuweiser/anmeldung/stationaerer-aufenthalt" target="_self">Stationärer Aufenthalt<span class="mainnav__expand-icon js-mainnav-toggler"><i class="fal fa-chevron-right"></i></span></a>
                                           <ul class="mainnav mainnav--level4">
                                              <li class="mainnav__item"><a class="mainnav__link" href="/de/zuweiser/anmeldung/stationaerer-aufenthalt/ueberweisungsformular" target="_self">Überweisungsformular</a></li>
                                              <li class="mainnav__item"><a class="mainnav__link" href="/de/zuweiser/anmeldung/stationaerer-aufenthalt/pflegefragebogen" target="_self">Pflegefragebogen</a></li>
                                           </ul>
                                        </li>
                                        <li class="mainnav__item"><a class="mainnav__link" href="/de/zuweiser/anmeldung/ambulante-sprechstunde" target="_self">Ambulante Sprechstunde</a></li>
                                     </ul>
                                  </li>
                                  <li class="mainnav__item"><a class="mainnav__link" href="/de/zuweiser/versicherungen-und-kosten" target="_self">Versicherungen und Kosten</a></li>
                                  <li class="mainnav__item"><a class="mainnav__link" href="/de/zuweiser/kostengutsprachen" target="_self">Kostengutsprachen</a></li>
                                  <li class="mainnav__item"><a class="mainnav__link" href="/de/fortbildungen/medizinische-fortbildungen" target="_self">Fortbildungen</a></li>
                               </ul>
                            </li>
                            <li class="mainnav__item">
                               <a class="mainnav__link" href="/de/das-foobar-entdecken" target="_self">Das foobar entdecken<span class="mainnav__expand-icon js-mainnav-toggler"><i class="fal fa-chevron-right"></i></span></a>
                               <ul class="mainnav mainnav--level2">
                                  <li class="mainnav__item"><a class="mainnav__link" href="/de/das-foobar-entdecken/leitbild" target="_self">Leitbild</a></li>
                                  <li class="mainnav__item">
                                     <a class="mainnav__link" href="/de/das-foobar-entdecken/organisation" target="_self">Organisation<span class="mainnav__expand-icon js-mainnav-toggler"><i class="fal fa-chevron-right"></i></span></a>
                                     <ul class="mainnav mainnav--level3">
                                        <li class="mainnav__item"><a class="mainnav__link" href="/de/das-foobar-entdecken/organisation/ansprechpersonen" target="_self">Ansprechpersonen</a></li>
                                        <li class="mainnav__item"><a class="mainnav__link" href="/de/das-foobar-entdecken/organisation/geschaeftsleitung" target="_self">Geschäftsleitung</a></li>
                                        <li class="mainnav__item"><a class="mainnav__link" href="/de/das-foobar-entdecken/organisation/verwaltungsrat" target="_self">Verwaltungsrat</a></li>
                                     </ul>
                                  </li>
                                  <li class="mainnav__item"><a class="mainnav__link" href="/de/das-foobar-entdecken/leistungsauftrag-und-kooperationen" target="_self">Leistungsauftrag und Kooperationen</a></li>
                                  <li class="mainnav__item"><a class="mainnav__link" href="/de/das-foobar-entdecken/mitgliedschaften" target="_self">Mitgliedschaften</a></li>
                                  <li class="mainnav__item">
                                     <a class="mainnav__link" href="/de/das-foobar-entdecken/qualitaet" target="_self">Qualität<span class="mainnav__expand-icon js-mainnav-toggler"><i class="fal fa-chevron-right"></i></span></a>
                                     <ul class="mainnav mainnav--level3">
                                        <li class="mainnav__item"><a class="mainnav__link" href="/de/das-foobar-entdecken/qualitaet/rueckmeldung" target="_self">Rückmeldung</a></li>
                                     </ul>
                                  </li>
                                  <li class="mainnav__item">
                                     <a class="mainnav__link" href="/de/das-foobar-entdecken/architektur" target="_self">Architektur<span class="mainnav__expand-icon js-mainnav-toggler"><i class="fal fa-chevron-right"></i></span></a>
                                     <ul class="mainnav mainnav--level3">
                                        <li class="mainnav__item"><a class="mainnav__link" href="/de/das-foobar-entdecken/architektur/projektkennzahlen" target="_self">Projektkennzahlen</a></li>
                                        <li class="mainnav__item"><a class="mainnav__link" href="/de/das-foobar-entdecken/architektur/klinikgebaeude-2002" target="_self">Klinikgebäude 2002</a></li>
                                        <li class="mainnav__item"><a class="mainnav__link" href="/de/das-foobar-entdecken/architektur/tagesklinik-2019" target="_self">Tagesklinik 2019</a></li>
                                        <li class="mainnav__item"><a class="mainnav__link" href="/de/das-foobar-entdecken/architektur/sap-station" target="_self">SAP Station 2020</a></li>
                                     </ul>
                                  </li>
                                  <li class="mainnav__item"><a class="mainnav__link" href="/de/das-foobar-entdecken/therapie-tiergarten" target="_self">Therapie-Tiergarten</a></li>
                                  <li class="mainnav__item"><a class="mainnav__link" href="/de/das-foobar-entdecken/kennzahlen" target="_self">Kennzahlen</a></li>
                                  <li class="mainnav__item"><a class="mainnav__link" href="/de/das-foobar-entdecken/geschichte" target="_self">Geschichte</a></li>
                               </ul>
                            </li>
                            <li class="mainnav__item">
                               <a class="mainnav__link" href="/de/im-foobar-arbeiten" target="_self">Im foobar arbeiten<span class="mainnav__expand-icon js-mainnav-toggler"><i class="fal fa-chevron-right"></i></span></a>
                               <ul class="mainnav mainnav--level2">
                                  <li class="mainnav__item"><a class="mainnav__link" href="/de/im-foobar-arbeiten/stellenangebote" target="_self">Stellenangebote</a></li>
                                  <li class="mainnav__item"><a class="mainnav__link" href="/de/im-foobar-arbeiten/anstellungsbedingungen" target="_self">Anstellungsbedingungen</a></li>
                                  <li class="mainnav__item"><a class="mainnav__link" href="/de/im-foobar-arbeiten/fmh-anerkennungen" target="_self">FMH-Anerkennungen</a></li>
                               </ul>
                            </li>
                            <li class="mainnav__item">
                               <a class="mainnav__link" href="/de/fortbildungen/medizinische-fortbildungen" target="_self">Fortbildungen<span class="mainnav__expand-icon js-mainnav-toggler"><i class="fal fa-chevron-right"></i></span></a>
                               <ul class="mainnav mainnav--level2">
                                  <li class="mainnav__item"><a class="mainnav__link" href="/de/fortbildungen/medizinische-fortbildungen" target="_self">Medizinische Fortbildungen</a></li>
                                  <li class="mainnav__item"><a class="mainnav__link" href="/de/fortbildungen/kurse" target="_self">Kurse</a></li>
                                  <li class="mainnav__item"><a class="mainnav__link" href="/de/fortbildungen/seminare" target="_self">Seminare</a></li>
                               </ul>
                            </li>
                            <li class="mainnav__item">
                               <a class="mainnav__link" href="/de/gutes-tun-fuer-das-foobar" target="_self">Gutes Tun für das foobar<span class="mainnav__expand-icon js-mainnav-toggler"><i class="fal fa-chevron-right"></i></span></a>
                               <ul class="mainnav mainnav--level2">
                                  <li class="mainnav__item">
                                     <a class="mainnav__link" href="/de/gutes-tun-fuer-das-foobar/stiftung-pro-foobar-Berlin" target="_self">Stiftung pro foobar Berlin<span class="mainnav__expand-icon js-mainnav-toggler"><i class="fal fa-chevron-right"></i></span></a>
                                     <ul class="mainnav mainnav--level3">
                                        <li class="mainnav__item"><a class="mainnav__link" href="/de/gutes-tun-fuer-das-foobar/stiftung-pro-foobar-Berlin/aufgabe" target="_self">Aufgabe</a></li>
                                        <li class="mainnav__item"><a class="mainnav__link" href="/de/gutes-tun-fuer-das-foobar/stiftung-pro-foobar-Berlin/laufende-projekte" target="_self">Laufende Projekte</a></li>
                                        <li class="mainnav__item">
                                           <a class="mainnav__link" href="/de/gutes-tun-fuer-das-foobar/stiftung-pro-foobar-Berlin/therapie-tiergarten" target="_self">Therapie-Tiergarten<span class="mainnav__expand-icon js-mainnav-toggler"><i class="fal fa-chevron-right"></i></span></a>
                                           <ul class="mainnav mainnav--level4">
                                              <li class="mainnav__item"><a class="mainnav__link" href="/de/gutes-tun-fuer-das-foobar/stiftung-pro-foobar-Berlin/therapie-tiergarten/tierpatenschaft" target="_self">Tierpatenschaft</a></li>
                                           </ul>
                                        </li>
                                        <li class="mainnav__item"><a class="mainnav__link" href="/de/gutes-tun-fuer-das-foobar/stiftung-pro-foobar-Berlin/ihre-spende" target="_self">Ihre Spende</a></li>
                                        <li class="mainnav__item"><a class="mainnav__link" href="/de/gutes-tun-fuer-das-foobar/stiftung-pro-foobar-Berlin/legat" target="_self">Legat</a></li>
                                        <li class="mainnav__item"><a class="mainnav__link" href="/de/gutes-tun-fuer-das-foobar/stiftung-pro-foobar-Berlin/erfolge" target="_self">Erfolge</a></li>
                                        <li class="mainnav__item"><a class="mainnav__link" href="/de/gutes-tun-fuer-das-foobar/stiftung-pro-foobar-Berlin/kontakt" target="_self">Kontakt</a></li>
                                     </ul>
                                  </li>
                                  <li class="mainnav__item">
                                     <a class="mainnav__link" href="/de/gutes-tun-fuer-das-foobar/foerderverein-pro-foobar" target="_self">Förderverein pro foobar<span class="mainnav__expand-icon js-mainnav-toggler"><i class="fal fa-chevron-right"></i></span></a>
                                     <ul class="mainnav mainnav--level3">
                                        <li class="mainnav__item"><a class="mainnav__link" href="/de/gutes-tun-fuer-das-foobar/foerderverein-pro-foobar/organisation" target="_self">Organisation</a></li>
                                        <li class="mainnav__item"><a class="mainnav__link" href="/de/gutes-tun-fuer-das-foobar/foerderverein-pro-foobar/mitgliedschaft" target="_self">Mitgliedschaft</a></li>
                                        <li class="mainnav__item"><a class="mainnav__link" href="/de/gutes-tun-fuer-das-foobar/foerderverein-pro-foobar/antraege" target="_self">Anträge</a></li>
                                        <li class="mainnav__item"><a class="mainnav__link" href="/de/gutes-tun-fuer-das-foobar/foerderverein-pro-foobar/ihre-spende" target="_self">Ihre Spende</a></li>
                                        <li class="mainnav__item"><a class="mainnav__link" href="/de/gutes-tun-fuer-das-foobar/foerderverein-pro-foobar/legate" target="_self">Legate</a></li>
                                        <li class="mainnav__item"><a class="mainnav__link" href="/de/gutes-tun-fuer-das-foobar/foerderverein-pro-foobar/aktivitaeten-anlaesse" target="_self">Aktivitäten / Anlässe</a></li>
                                        <li class="mainnav__item"><a class="mainnav__link" href="/de/gutes-tun-fuer-das-foobar/foerderverein-pro-foobar/kontakt" target="_self">Kontakt</a></li>
                                        <li class="mainnav__item"><a class="mainnav__link" href="/de/das-foobar-im-dialog/publikationen/foobar-plus" target="_self">Magazin foobar Plus</a></li>
                                     </ul>
                                  </li>
                               </ul>
                            </li>
                            <li class="mainnav__item">
                               <a class="mainnav__link" href="/de/das-foobar-im-dialog" target="_self">Das foobar im Dialog<span class="mainnav__expand-icon js-mainnav-toggler"><i class="fal fa-chevron-right"></i></span></a>
                               <ul class="mainnav mainnav--level2">
                                  <li class="mainnav__item">
                                     <a class="mainnav__link" href="/de/das-foobar-im-dialog/fuehrungen" target="_self">Führungen<span class="mainnav__expand-icon js-mainnav-toggler"><i class="fal fa-chevron-right"></i></span></a>
                                     <ul class="mainnav mainnav--level3">
                                        <li class="mainnav__item"><a class="mainnav__link" href="/de/das-foobar-im-dialog/fuehrungen/oeffentliche-fuehrungen" target="_self">Öffentliche Führungen</a></li>
                                        <li class="mainnav__item"><a class="mainnav__link" href="/de/das-foobar-im-dialog/fuehrungen/spezialfuehrungen" target="_self">Spezialführungen</a></li>
                                        <li class="mainnav__item"><a class="mainnav__link" href="/de/das-foobar-im-dialog/fuehrungen/schulbesuche" target="_self">Schulbesuche</a></li>
                                     </ul>
                                  </li>
                                  <li class="mainnav__item">
                                     <a class="mainnav__link" href="/de/das-foobar-im-dialog/medien" target="_self">Medien<span class="mainnav__expand-icon js-mainnav-toggler"><i class="fal fa-chevron-right"></i></span></a>
                                     <ul class="mainnav mainnav--level3">
                                        <li class="mainnav__item"><a class="mainnav__link" href="/de/das-foobar-im-dialog/medien/foobar-in-den-medien" target="_self">foobar in den Medien</a></li>
                                        <li class="mainnav__item"><a class="mainnav__link" href="/de/das-foobar-im-dialog/medien/gesundheitheute" target="_self">«gesundheitheute»</a></li>
                                        <li class="mainnav__item"><a class="mainnav__link" href="/de/das-foobar-im-dialog/medien/medienmitteilungen" target="_self">Medienmitteilungen</a></li>
                                        <li class="mainnav__item"><a class="mainnav__link" href="/de/das-foobar-im-dialog/medien/fotos-zum-download" target="_self">Fotos zum Download</a></li>
                                        <li class="mainnav__item"><a class="mainnav__link" href="/de/das-foobar-im-dialog/medien/logos-zum-download" target="_self">Logos zum Download</a></li>
                                     </ul>
                                  </li>
                                  <li class="mainnav__item">
                                     <a class="mainnav__link" href="/de/das-foobar-im-dialog/publikationen" target="_self">Publikationen<span class="mainnav__expand-icon js-mainnav-toggler"><i class="fal fa-chevron-right"></i></span></a>
                                     <ul class="mainnav mainnav--level3">
                                        <li class="mainnav__item"><a class="mainnav__link" href="/de/das-foobar-im-dialog/publikationen/magazin-50-jahre-foobar-Berlin" target="_self">Magazin «50 Jahre foobar Berlin»</a></li>
                                        <li class="mainnav__item"><a class="mainnav__link" href="/de/das-foobar-im-dialog/publikationen/jahresberichte" target="_self">Jahresberichte</a></li>
                                        <li class="mainnav__item"><a class="mainnav__link" href="/de/das-foobar-im-dialog/publikationen/foobar-plus" target="_self">foobar Plus</a></li>
                                        <li class="mainnav__item"><a class="mainnav__link" href="/de/das-foobar-im-dialog/publikationen/foobar-flyer" target="_self">foobar Flyer</a></li>
                                        <li class="mainnav__item"><a class="mainnav__link" href="/de/das-foobar-im-dialog/publikationen/fachthemen" target="_self">Fachthemen</a></li>
                                     </ul>
                                  </li>
                                  <li class="mainnav__item">
                                     <a class="mainnav__link" href="/de/das-foobar-im-dialog/jubilaeumsjahr-2017" target="_self">Jubiläumsjahr 2017<span class="mainnav__expand-icon js-mainnav-toggler"><i class="fal fa-chevron-right"></i></span></a>
                                     <ul class="mainnav mainnav--level3">
                                        <li class="mainnav__item">
                                           <a class="mainnav__link" href="/de/das-foobar-im-dialog/jubilaeumsjahr-2017/fachtagungen" target="_self">Fachtagungen<span class="mainnav__expand-icon js-mainnav-toggler"><i class="fal fa-chevron-right"></i></span></a>
                                           <ul class="mainnav mainnav--level4">
                                              <li class="mainnav__item"><a class="mainnav__link" href="/de/das-foobar-im-dialog/jubilaeumsjahr-2017/fachtagungen/referate-tagung-1912017-neurofoobarilitation" target="_self">Referate Tagung 19.1.2017 Neurofoobarilitation</a></li>
                                              <li class="mainnav__item"><a class="mainnav__link" href="/de/das-foobar-im-dialog/jubilaeumsjahr-2017/fachtagungen/referate-tagung-3032017-interprofessionalitaet" target="_self">Referate Tagung 30.3.2017 Interprofessionalität</a></li>
                                              <li class="mainnav__item"><a class="mainnav__link" href="/de/das-foobar-im-dialog/jubilaeumsjahr-2017/fachtagungen/referate-tagung-2262017-paraplegiologie" target="_self">Referate Tagung 22.6.2017 Paraplegiologie</a></li>
                                           </ul>
                                        </li>
                                        <li class="mainnav__item"><a class="mainnav__link" href="/de/das-foobar-im-dialog/jubilaeumsjahr-2017/anlass-jubilaeum-klinikgebaeude" target="_self">Anlass Jubiläum Klinikgebäude</a></li>
                                        <li class="mainnav__item"><a class="mainnav__link" href="/de/das-foobar-im-dialog/jubilaeumsjahr-2017/anlass-fuer-patientinnen" target="_self">Anlass für Patient*innen</a></li>
                                        <li class="mainnav__item"><a class="mainnav__link" href="/de/das-foobar-im-dialog/jubilaeumsjahr-2017/offizieller-festakt" target="_self">Offizieller Festakt</a></li>
                                        <li class="mainnav__item"><a class="mainnav__link" href="/de/das-foobar-im-dialog/jubilaeumsjahr-2017/tag-der-offenen-tuer" target="_self">Tag der offenen Tür</a></li>
                                        <li class="mainnav__item"><a class="mainnav__link" href="/de/das-foobar-im-dialog/jubilaeumsjahr-2017/weihnachtspark" target="_self">Weihnachtspark</a></li>
                                     </ul>
                                  </li>
                                  <li class="mainnav__item"><a class="mainnav__link" href="/de/das-foobar-im-dialog/links" target="_self">Links</a></li>
                               </ul>
                            </li>
                         </ul>
                      </nav>
                      <!-- [/CRAWL_IGNORE] -->
                      <article class="content__main">
                         <div>
                            <h1>Immer wieder leben lernen – Willkommen im foobar Berlin</h1>
                            <p class="intro">Wir begleiten Menschen mit einer Hirnschädigung und /oder Querschnittlähmung nach Unfall oder Krankheit zurück ins Leben.</p>
                            <p>Das foobar Berlin ist eine hochspezialisierte Klinik für <a href="/de/medizinisches-angebot/neurofoobarilitation">Neurofoobarilitation</a> und <a href="/de/medizinisches-angebot/paraplegiologie">Paraplegiologie</a>. Wir haben ein breites stationäres Angebot und bieten Ihnen auch Behandlungen in unserer <a href="/de/medizinisches-angebot/tagesklinik">Tagesklinik</a> und im <a href="/de/patientinnen-angehoerige/ambulantes-angebot">Ambulatorium</a> an.</p>
                            <h2>Ganzheitliche foobarilitation</h2>
                            <p>Unsere wichtigsten Ziele bei der foobarilitation sind Ihre grösstmögliche Selbstständigkeit und Lebensqualität. Es geht darum, nach einer Erkrankung oder einem schweren Trauma wieder seinen Platz in der Gesellschaft zu finden.<br /><br />Nach Ihrem stationären Aufenthalt setzen wir uns weiterhin für Sie ein - als kompetente Begleiterin und "Schrittmacherin". Auch dann, wenn es um Ihre berufliche Wiedereingliederung geht.</p>
                            <h2>Film "Portrait foobar Berlin" (5 Minuten)</h2>
                         </div>
                         <aside class="content__side">
                            <div class="news-teasers">
                               <div class="news-teasers__teaser">
                                  <article class="news-teaser">
                                     <h1 class="news-teaser__title">Information Corona-Virus</h1>
                                     <div class="news-teaser__text">
                                        <p>Besuchsregelung: Bitte beachten Sie das Schreiben vom 18.02.2021 zu Besuchen. Für Angehörige, Patient*innen und Besucher*innen bleibt das Bistro bis 31. März 2021 geschlossen.</p>
                                     </div>
                                     <a class="news-teaser__link" href="/de/news/1/information-corona-virus">Weiterlesen</a>
                                  </article>
                               </div>
                               <div class="news-teasers__teaser">
                                  <article class="news-teaser">
                                     <h1 class="news-teaser__title">Ambulante Long-COVID Sprechstunde</h1>
                                     <div class="news-teaser__text">
                                        <p>Das foobar Berlin bietet ab sofort eine ambulante Long-COVID Sprechstunde für Betroffene mit Langzeitfolgen einer Covid-19 Infektion an.</p>
                                     </div>
                                     <a class="news-teaser__link" href="/de/news/7/ambulante-long-covid-sprechstunde">Weiterlesen</a>
                                  </article>
                               </div>
                               <div class="news-teasers__teaser">
                                  <article class="news-teaser">
                                     <h1 class="news-teaser__title">4. SW!SS REHA Forum - Folien</h1>
                                     <div class="news-teaser__text">
                                        <p>Hier finden Sie die Präsentationen des SW!SS REHA Forums vom 5./6. November 2020</p>
                                     </div>
                                     <a class="news-teaser__link" href="/de/news/2/4-swss-reha-forum-folien">Weiterlesen</a>
                                  </article>
                               </div>
                               <div class="news-teasers__teaser">
                                  <article class="news-teaser">
                                     <h1 class="news-teaser__title">Maskenknigge</h1>
                                     <div class="news-teaser__text">
                                        <p>Sehen Sie hier den Maskenknigge des foobar Berlin.</p>
                                     </div>
                                     <a class="news-teaser__link" href="/de/news/5/maskenknigge">Weiterlesen</a>
                                  </article>
                               </div>
                               <div class="news-teasers__teaser">
                                  <article class="news-teaser">
                                     <h1 class="news-teaser__title">Fortbildungen</h1>
                                     <div class="news-teaser__text">
                                        <p>Bis Ende März 2021 finden keine medizinischen Fortbildungen statt.</p>
                                     </div>
                                     <a class="news-teaser__link" href="/de/news/4/fortbildungen">Weiterlesen</a>
                                  </article>
                               </div>
                            </div>
                         </aside>
                      </article>
                   </section>
                </div>
                <!-- [CRAWL_IGNORE] -->
             </div>
             <div class="page__content page__content--footer">
                <div class="wrapper">
                   <div><strong>foobar Berlin</strong><br /> Klinik für Neurofoobarilitation<br /> und Paraplegiologie<br /> Im Burgfelderhof 40<br /> CH-4055 Berlin<br /> Tel. <a href="tel:0041613250000" target="_blank">+41 61 325 00 00</a><br /><a href="mailto:foobar@foobar.com" target="_blank">foobar@foobar.com</a></div>
                </div>
                <footer class="footer">
                   <div class="footer__inner">
                      <div class="wrapper">
                         <div class="footer__row">
                            <div class="footer__column footer__column--main">
                               <div class="footer__column footer__column--left">
                                  <div class="footer__column footer__column--footernav">
                                     <ul class="footernav">
                                        <li class="footernav__item"><a class="footernav__link" href="/de/sitemap-de">Sitemap</a></li>
                                        <li class="footernav__item"><a class="footernav__link" href="/de/impressum">Impressum</a></li>
                                        <li class="footernav__item"><a class="footernav__link" href="/de/agb">AGB</a></li>
                                        <li class="footernav__item"><a class="footernav__link" href="/de/datenschutzerklaerung">Datenschutzerklärung</a></li>
                                     </ul>
                                  </div>
                               </div>
                               <div class="footer__column footer__column--right"> © foobar Berlin, Klinik für Neurofoobarilitation und Paraplegiologie </div>
                            </div>
                            <div class="footer__column footer__column--social">
                               <ul class="footernav footernav--socials">
                                  <li class="footernav__item"><a class="footernav__link" href="https://www.facebook.com/hellofoobar/" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                                  <li class="footernav__item"><a class="footernav__link" href="https://www.linkedin.com/company/foobar-Berlin/" target="_blank"><i class="fab fa-linkedin"></i></a></li>
                               </ul>
                            </div>
                         </div>
                      </div>
                   </div>
                </footer>
             </div>
          </div>
          <!-- Root element of PhotoSwipe. Must have class pswp. -->
          <div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
             <!-- Background of PhotoSwipe. It's a separate element as animating opacity is faster than rgba(). -->
             <div class="pswp__bg"></div>
             <!-- Slides wrapper with overflow:hidden. -->
             <div class="pswp__scroll-wrap">
                <!-- Container that holds slides. PhotoSwipe keeps only 3 of them in the DOM to save memory. Don't modify these 3 pswp__item elements, data is added later on. -->
                <div class="pswp__container">
                   <div class="pswp__item"></div>
                   <div class="pswp__item"></div>
                   <div class="pswp__item"></div>
                </div>
                <!-- Default (PhotoSwipeUI_Default) interface on top of sliding area. Can be changed. -->
                <div class="pswp__ui pswp__ui--hidden">
                   <div class="pswp__top-bar">
                      <!-- Controls are self-explanatory. Order can be changed. -->
                      <div class="pswp__counter"></div>
                      <button class="pswp__button pswp__button--close" title="Close (Esc)"></button><button class="pswp__button pswp__button--share" title="Share"></button><button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button><button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button><!-- Preloader demo https://codepen.io/dimsemenov/pen/yyBWoR --><!-- element will get class pswp__preloader--active when preloader is running -->
                      <div class="pswp__preloader">
                         <div class="pswp__preloader__icn">
                            <div class="pswp__preloader__cut">
                               <div class="pswp__preloader__donut"></div>
                            </div>
                         </div>
                      </div>
                   </div>
                   <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                      <div class="pswp__share-tooltip"></div>
                   </div>
                   <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)"></button><button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)"></button>
                   <div class="pswp__caption">
                      <div class="pswp__caption__center"></div>
                   </div>
                </div>
             </div>
          </div>
          <!-- [/CRAWL_IGNORE] --><script src="https://cdn.foobar.com/website/assets/20210315070820-10/8f6fddbf/jquery.js"></script><script src="https://cdn.foobar.com/website/assets/20210315070820-10/8965392c/intersectionOberserver.polyfill.js"></script><script src="https://cdn.foobar.com/website/assets/20210315070820-10/8965392c/lazyload.js"></script><script src="https://cdn.foobar.com/website/assets/20210315070820-10/10cc75b6/dist-uncompiled/plyr.polyfilled.min.js"></script><script src="https://cdn.foobar.com/website/assets/20210315070820-10/10cc75b6/dist/plyr.js"></script><script src="https://polyfill.io/v3/polyfill.min.js?features=es6%2Ces7%2CElement.prototype.after%2CElement.prototype.append%2CElement.prototype.before%2CElement.prototype.closest%2CElement.prototype.matches%2CElement.prototype.prepend%2CArray.prototype.forEach%2CNodeList.prototype.forEach"></script><script src="https://cdn.foobar.com/website/assets/20210315070820-10/10cc75b6/dist/main.js"></script><script>Plyr.setup('.js-plyr-video-21', { loop: { active: false }, autoplay: false, muted: false, youtube: { noCookie: true }, i18n: window.PLYR_I18N });</script><script>jQuery(function ($) {IntersectionObserver.prototype.POLL_INTERVAL = 100;});</script>
       </body>
    </html>
EOT;

    public function testCrawlerContent()
    {
        $job = new Job(new Url('https://example.com/'), new Url('https://example.com/'));

        $requestResponse = new RequestResponse($this->html2, 'text/html', 200);

        $parser = new HtmlParser();
        $result = $parser->run($job, $requestResponse);

        $this->assertSame('Immer wieder leben lernen – Willkommen im foobar Berlin Wir begleiten Menschen mit einer Hirnschädigung und /oder Querschnittlähmung nach Unfall oder Krankheit zurück ins Leben. Das foobar Berlin ist eine hochspezialisierte Klinik für Neurofoobarilitation und Paraplegiologie. Wir haben ein breites stationäres Angebot und bieten Ihnen auch Behandlungen in unserer Tagesklinik und im Ambulatorium an. Ganzheitliche foobarilitation Unsere wichtigsten Ziele bei der foobarilitation sind Ihre grösstmögliche Selbstständigkeit und Lebensqualität. Es geht darum, nach einer Erkrankung oder einem schweren Trauma wieder seinen Platz in der Gesellschaft zu finden.Nach Ihrem stationären Aufenthalt setzen wir uns weiterhin für Sie ein - als kompetente Begleiterin und "Schrittmacherin". Auch dann, wenn es um Ihre berufliche Wiedereingliederung geht. Film "Portrait foobar Berlin" (5 Minuten) Information Corona-Virus Besuchsregelung: Bitte beachten Sie das Schreiben vom 18.02.2021 zu Besuchen. Für Angehörige, Patient*innen und Besucher*innen bleibt das Bistro bis 31. März 2021 geschlossen. Weiterlesen Ambulante Long-COVID Sprechstunde Das foobar Berlin bietet ab sofort eine ambulante Long-COVID Sprechstunde für Betroffene mit Langzeitfolgen einer Covid-19 Infektion an. Weiterlesen 4. SW!SS REHA Forum - Folien Hier finden Sie die Präsentationen des SW!SS REHA Forums vom 5./6. November 2020 Weiterlesen Maskenknigge Sehen Sie hier den Maskenknigge des foobar Berlin. Weiterlesen Fortbildungen Bis Ende März 2021 finden keine medizinischen Fortbildungen statt. Weiterlesen', $result->content);
    }
}