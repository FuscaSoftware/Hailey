<?php

/*
 * The MIT License
 *
 * Copyright 2015 s.kalski.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

/**
 * Description of HAILEY_Network
 *
 * @author s.kalski
 */
abstract class HAILEY_Network {

    function parseUrl($url = '', $type = 'tld') {
        $url_parts = parse_url($url);
        $domain = $url_parts['host'];
        $res = $this->urlInformations();
        while ($arr = $res) {
            $tmp_tld = substr($domain, -strlen("." . $arr[0]));
            if ($tmp_tld == "." . $arr[0]) {
                $tld = ltrim($arr[0], ".");
                $domainLeft = substr($domain, 0, -(strlen($tld) + 1));
                if (strpos($domainLeft, ".") === false) {
                    $subDomain = "";
                    $finalDomain = $domainLeft;
                } else {
                    $domain_parts = explode(".", $domainLeft);
                    $finalDomain = array_pop($domain_parts);
                    $subDomain = implode(".", $domain_parts);
                }
                switch ($i) {
                    case 'tld':
                        return $tld;
                    case 'domainname':
                        return $finalDomain;
                    case 'subdomain':
                        return (!empty($subDomain)) ? $subDomain : "n/a";
                }
                break;
            }
        }
    }

    function getRemoteIP() {
        $ip = $_SERVER['REMOTE_ADDR'];
        return $ip;
    }

    function getRealIPAddr() {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {   //check ip from share internet
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {   //to check ip is pass from proxy
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }

    function IsIPValid($ip) {
        if (preg_match('/^[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}$/', $ip)) {
            return true;
        }
        return false;
    }

    function urlInformations() {
        $urlInformations = array(
            array('ac', 'whois.nic.ac', 'No match'),
            array('ac.cn', 'whois.cnnic.net.cn', 'no matching record'),
            array('ac.jp', 'whois.nic.ad.jp', 'No match'),
            array('ac.uk', 'whois.ja.net', 'No such domain'),
            array('ad.jp', 'whois.nic.ad.jp', 'No match'),
            array('adm.br', 'whois.nic.br', 'No match'),
            array('adv.br', 'whois.nic.br', 'No match'),
            array('aero', 'whois.information.aero', 'is available'),
            array('ag', 'whois.nic.ag', 'Not found'),
            array('agr.br', 'whois.nic.br', 'No match'),
            array('ah.cn', 'whois.cnnic.net.cn', 'No entries found'),
            array('al', 'whois.ripe.net', 'No entries found'),
            array('am', 'whois.amnic.net', 'No match'),
            array('am.br', 'whois.nic.br', 'No match'),
            array('arq.br', 'whois.nic.br', 'No match'),
            array('art.br', 'whois.nic.br', 'No match'),
            array('as', 'whois.nic.as', 'Domain Not Found'),
            array('asn.au', 'whois.aunic.net', 'No Data Found'),
            array('at', 'whois.nic.at', 'nothing found'),
            array('ato.br', 'whois.nic.br', 'No match'),
            array('au', 'whois.aunic.net', 'No Data Found'),
            array('av.tr', 'whois.nic.tr', 'Not found in database'),
            array('az', 'whois.ripe.net', 'no entries found'),
            array('ba', 'whois.ripe.net', 'No match for'),
            array('be', 'whois.geektools.com', 'No such domain'),
            array('bel.tr', 'whois.nic.tr', 'Not found in database'),
            array('bg', 'whois.digsys.bg', 'does not exist'),
            array('bio.br', 'whois.nic.br', 'No match'),
            array('biz', 'whois.biz', 'Not found'),
            array('biz.tr', 'whois.nic.tr', 'Not found in database'),
            array('bj.cn', 'whois.cnnic.net.cn', 'No entries found'),
            array('bmd.br', 'whois.nic.br', 'No match'),
            array('br', 'whois.registro.br', 'No match'),
            array('by', 'whois.ripe.net', 'no entries found'),
            array('ca', 'whois.cira.ca', 'Status: AVAIL'),
            array('cc', 'whois.nic.cc', 'No match'),
            array('cd', 'whois.cd', 'No match'),
            array('ch', 'whois.nic.ch', 'We do not have an entry'),
            array('cim.br', 'whois.nic.br', 'No match'),
            array('ck', 'whois.ck-nic.org.ck', 'No entries found'),
            array('cl', 'whois.nic.cl', 'no existe'),
            array('cn', 'whois.cnnic.net.cn', 'No entries found'),
            array('cng.br', 'whois.nic.br', 'No match'),
            array('cnt.br', 'whois.nic.br', 'No match'),
            array('co.at', 'whois.nic.at', 'nothing found'),
            array('co.jp', 'whois.nic.ad.jp', 'No match'),
            array('co.uk', 'whois.nic.uk', 'No match for'),
            array('com', 'whois.crsnic.net', 'No match'),
            array('com.au', 'whois.aunic.net', 'No Data Found'),
            array('com.br', 'whois.nic.br', 'No match'),
            array('com.cn', 'whois.cnnic.net.cn', 'No entries found'),
            array('com.eg', 'whois.ripe.net', 'No entries found'),
            array('com.hk', 'whois.hknic.net.hk', 'No Match for'),
            array('com.mx', 'whois.nic.mx', 'Nombre del Dominio'),
            array('com.ru', 'whois.ripn.ru', 'No entries found'),
            array('com.tr', 'whois.nic.tr', 'Not found in database'),
            array('com.tw', 'whois.twnic.net', 'NO MATCH TIP'),
            array('conf.au', 'whois.aunic.net', 'No entries found'),
            array('cq.cn', 'whois.cnnic.net.cn', 'No entries found'),
            array('csiro.au', 'whois.aunic.net', 'No Data Found'),
            array('cx', 'whois.nic.cx', 'No match'),
            array('cy', 'whois.ripe.net', 'no entries found'),
            array('cz', 'whois.nic.cz', 'No data found'),
            array('de', 'whois.denic.de', 'not found'),
            array('dk', 'whois.dk-hostmaster.dk', 'No entries found'),
            array('dr.tr', 'whois.nic.tr', 'Not found in database'),
            array('dz', 'whois.ripe.net', 'no entries found'),
            array('ecn.br', 'whois.nic.br', 'No match'),
            array('edu', 'whois.crsnic.net', 'No match'),
            array('edu.au', 'whois.aunic.net', 'No Data Found'),
            array('edu.br', 'whois.nic.br', 'No match'),
            array('edu.tr', 'whois.nic.tr', 'Not found in database'),
            array('ee', 'whois.eenet.ee', 'NOT FOUND'),
            array('eg', 'whois.ripe.net', 'No entries found'),
            array('emu.id.au', 'whois.aunic.net', 'No Data Found'),
            array('eng.br', 'whois.nic.br', 'No match'),
            array('es', 'whois.ripe.net', 'No entries found'),
            array('esp.br', 'whois.nic.br', 'No match'),
            array('etc.br', 'whois.nic.br', 'No match'),
            array('eti.br', 'whois.nic.br', 'No match'),
            array('eu', 'whois.eu', 'Status:      FREE'),
            array('eun.eg', 'whois.ripe.net', 'No entries found'),
            array('far.br', 'whois.nic.br', 'No match'),
            array('fi', 'whois.ripe.net', 'No entries found'),
            array('fj', 'whois.usp.ac.fj', ''),
            array('fj.cn', 'whois.cnnic.net.cn', 'No entries found'),
            array('fm.br', 'whois.nic.br', 'No match'),
            array('fnd.br', 'whois.nic.br', 'No match'),
            array('fo', 'whois.ripe.net', 'no entries found'),
            array('fot.br', 'whois.nic.br', 'No match'),
            array('fr', 'whois.nic.fr', 'No entries found'),
            array('fst.br', 'whois.nic.br', 'No match'),
            array('g12.br', 'whois.nic.br', 'No match'),
            array('gb', 'whois.ripe.net', 'No match for'),
            array('gb.com', 'whois.nomination.net', 'No match for'),
            array('gb.net', 'whois.nomination.net', 'No match for'),
            array('gd.cn', 'whois.cnnic.net.cn', 'No entries found'),
            array('ge', 'whois.ripe.net', 'no entries found'),
            array('gen.tr', 'whois.nic.tr', 'Not found in database'),
            array('ggf.br', 'whois.nic.br', 'No match'),
            array('gl', 'whois.ripe.net', 'no entries found'),
            array('gob.mx', 'whois.nic.mx', 'Nombre del Dominio'),
            array('gov.au', 'whois.aunic.net', 'No Data Found'),
            array('gov.br', 'whois.nic.br', 'No match'),
            array('gov.cn', 'whois.cnnic.net.cn', 'No entries found'),
            array('gov.hk', 'whois.hknic.net.hk', 'No Match for'),
            array('gov.tr', 'whois.nic.tr', 'Not found in database'),
            array('gr', 'whois.ripe.net', 'no entries found'),
            array('gr.jp', 'whois.nic.ad.jp', 'No match'),
            array('gs', 'whois.adamsnames.tc', 'is not registered'),
            array('gs.cn', 'whois.cnnic.net.cn', 'No entries found'),
            array('gx.cn', 'whois.cnnic.net.cn', 'No entries found'),
            array('gz.cn', 'whois.cnnic.net.cn', 'No entries found'),
            array('ha.cn', 'whois.cnnic.net.cn', 'No entries found'),
            array('hb.cn', 'whois.cnnic.net.cn', 'No entries found'),
            array('he.cn', 'whois.cnnic.net.cn', 'No entries found'),
            array('hi.cn', 'whois.cnnic.net.cn', 'No entries found'),
            array('hk', 'whois.hknic.net.hk', 'No Match for'),
            array('hk.cn', 'whois.cnnic.net.cn', 'No entries found'),
            array('hl.cn', 'whois.cnnic.net.cn', 'No entries found'),
            array('hm', 'whois.registry.hm', '(null)'),
            array('hn.cn', 'whois.cnnic.net.cn', 'No entries found'),
            array('hu', 'whois.ripe.net', 'MAXCHARS:500'),
            array('id.au', 'whois.aunic.net', 'No Data Found'),
            array('idv.tw', 'whois.twnic.net', 'NO MATCH TIP'),
            array('ie', 'whois.domainregistry.ie', 'no match'),
            array('il', 'whois.isoc.org.il', 'No data was found'),
            array('imb.br', 'whois.nic.br', 'No match'),
            array('ind.br', 'whois.nic.br', 'No match'),
            array('inf.br', 'whois.nic.br', 'No match'),
            array('info', 'whois.afilias.info', 'Not found'),
            array('info.au', 'whois.aunic.net', 'No Data Found'),
            array('info.tr', 'whois.nic.tr', 'Not found in database'),
            array('int', 'whois.iana.org', 'not found'),
            array('is', 'whois.isnic.is', 'No entries found'),
            array('it', 'whois.nic.it', 'No entries found'),
            array('jl.cn', 'whois.cnnic.net.cn', 'No entries found'),
            array('jor.br', 'whois.nic.br', 'No match'),
            array('jp', 'whois.nic.ad.jp', 'No match'),
            array('js.cn', 'whois.cnnic.net.cn', 'No entries found'),
            array('jx.cn', 'whois.cnnic.net.cn', 'No entries found'),
            array('k12.tr', 'whois.nic.tr', 'Not found in database'),
            array('ke', 'whois.rg.net', 'No match for'),
            array('kr', 'whois.krnic.net', 'is not registered'),
            array('la', 'whois.nic.la', 'NO MATCH'),
            array('lel.br', 'whois.nic.br', 'No match'),
            array('li', 'whois.nic.ch', 'We do not have an entry'),
            array('lk', 'whois.nic.lk', 'No domain registered'),
            array('ln.cn', 'whois.cnnic.net.cn', 'No entries found'),
            array('lt', 'ns.litnet.lt', 'No matches found'),
            array('ltd.uk', 'whois.nic.uk', 'No match for'),
            array('lu', 'whois.dns.lu', 'No entries found'),
            array('lv', 'whois.ripe.net', 'no entries found'),
            array('ma', 'whois.ripe.net', 'No entries found'),
            array('mat.br', 'whois.nic.br', 'No match'),
            array('mc', 'whois.ripe.net', 'No entries found'),
            array('md', 'whois.ripe.net', 'No match for'),
            array('me.uk', 'whois.nic.uk', 'No match for'),
            array('med.br', 'whois.nic.br', 'No match'),
            array('mil', 'whois.nic.mil', 'No match'),
            array('mil.br', 'whois.nic.br', 'No match'),
            array('mil.tr', 'whois.nic.tr', 'Not found in database'),
            array('mk', 'whois.ripe.net', 'No match for'),
            array('mn', 'whois.nic.mn', 'Domain not found'),
            array('mo.cn', 'whois.cnnic.net.cn', 'No entries found'),
            array('ms', 'whois.adamsnames.tc', 'is not registered'),
            array('mt', 'whois.ripe.net', 'No Entries found'),
            array('mus.br', 'whois.nic.br', 'No match'),
            array('mx', 'whois.nic.mx', 'Nombre del Dominio'),
            array('name', 'whois.nic.name', 'No match'),
            array('name.tr', 'whois.nic.tr', 'Not found in database'),
            array('ne.jp', 'whois.nic.ad.jp', 'No match'),
            array('net', 'whois.crsnic.net', 'No match'),
            array('net.au', 'whois.aunic.net', 'No Data Found'),
            array('net.br', 'whois.nic.br', 'No match'),
            array('net.cn', 'whois.cnnic.net.cn', 'No entries found'),
            array('net.eg', 'whois.ripe.net', 'No entries found'),
            array('net.hk', 'whois.hknic.net.hk', 'No Match for'),
            array('net.lu', 'whois.dns.lu', 'No entries found'),
            array('net.mx', 'whois.nic.mx', 'Nombre del Dominio'),
            array('net.ru', 'whois.ripn.ru', 'No entries found'),
            array('net.tr', 'whois.nic.tr', 'Not found in database'),
            array('net.tw', 'whois.twnic.net', 'NO MATCH TIP'),
            array('net.uk', 'whois.nic.uk', 'No match for'),
            array('nl', 'whois.domain-registry.nl', 'is not a registered domain'),
            array('nm.cn', 'whois.cnnic.net.cn', 'No entries found'),
            array('no', 'whois.norid.no', 'no matches'),
            array('no.com', 'whois.nomination.net', 'No match for'),
            array('nom.br', 'whois.nic.br', 'No match'),
            array('not.br', 'whois.nic.br', 'No match'),
            array('ntr.br', 'whois.nic.br', 'No match'),
            array('nu', 'whois.nic.nu', 'NO MATCH for'),
            array('nx.cn', 'whois.cnnic.net.cn', 'No entries found'),
            array('nz', 'whois.domainz.net.nz', 'Not Listed'),
            array('odo.br', 'whois.nic.br', 'No match'),
            array('oop.br', 'whois.nic.br', 'No match'),
            array('or.at', 'whois.nic.at', 'nothing found'),
            array('or.jp', 'whois.nic.ad.jp', 'No match'),
            array('org', 'whois.pir.org', 'NOT FOUND'),
            array('org.au', 'whois.aunic.net', 'No Data Found'),
            array('org.br', 'whois.nic.br', 'No match'),
            array('org.cn', 'whois.cnnic.net.cn', 'No entries found'),
            array('org.hk', 'whois.hknic.net.hk', 'No Match for'),
            array('org.lu', 'whois.dns.lu', 'No entries found'),
            array('org.ru', 'whois.ripn.ru', 'No entries found'),
            array('org.tr', 'whois.nic.tr', 'Not found in database'),
            array('org.tw', 'whois.twnic.net', 'NO MATCH TIP'),
            array('org.uk', 'whois.nic.uk', 'No match for'),
            array('pk', 'whois.pknic.net', 'is not registered'),
            array('pl', 'whois.ripe.net', 'No information about'),
            array('plc.uk', 'whois.nic.uk', 'No match for'),
            array('pol.tr', 'whois.nic.tr', 'Not found in database'),
            array('pp.ru', 'whois.ripn.ru', 'No entries found'),
            array('ppg.br', 'whois.nic.br', 'No match'),
            array('pro.br', 'whois.nic.br', 'No match'),
            array('psc.br', 'whois.nic.br', 'No match'),
            array('psi.br', 'whois.nic.br', 'No match'),
            array('pt', 'whois.ripe.net', 'No match for'),
            array('qh.cn', 'whois.cnnic.net.cn', 'No entries found'),
            array('qsl.br', 'whois.nic.br', 'No match'),
            array('rec.br', 'whois.nic.br', 'No match'),
            array('ro', 'whois.ripe.net', 'No entries found'),
            array('ru', 'whois.ripn.ru', 'No entries found'),
            array('sc.cn', 'whois.cnnic.net.cn', 'No entries found'),
            array('sd.cn', 'whois.cnnic.net.cn', 'No entries found'),
            array('se', 'whois.nic-se.se', 'No data found'),
            array('se.com', 'whois.nomination.net', 'No match for'),
            array('se.net', 'whois.nomination.net', 'No match for'),
            array('sg', 'whois.nic.net.sg', 'NO entry found'),
            array('sh', 'whois.nic.sh', 'No match for'),
            array('sh.cn', 'whois.cnnic.net.cn', 'No entries found'),
            array('si', 'whois.arnes.si', 'No entries found'),
            array('sk', 'whois.ripe.net', 'no entries found'),
            array('slg.br', 'whois.nic.br', 'No match'),
            array('sm', 'whois.ripe.net', 'no entries found'),
            array('sn.cn', 'whois.cnnic.net.cn', 'No entries found'),
            array('srv.br', 'whois.nic.br', 'No match'),
            array('st', 'whois.nic.st', 'No entries found'),
            array('su', 'whois.ripe.net', 'No entries found'),
            array('sx.cn', 'whois.cnnic.net.cn', 'No entries found'),
            array('tc', 'whois.adamsnames.tc', 'is not registered'),
            array('tel.tr', 'whois.nic.tr', 'Not found in database'),
            array('th', 'whois.nic.uk', 'No entries found'),
            array('tj.cn', 'whois.cnnic.net.cn', 'No entries found'),
            array('tm', 'whois.nic.tm', 'No match for'),
            array('tmp.br', 'whois.nic.br', 'No match'),
            array('tn', 'whois.ripe.net', 'No entries found'),
            array('to', 'whois.tonic.to', 'No match'),
            array('trd.br', 'whois.nic.br', 'No match'),
            array('tur.br', 'whois.nic.br', 'No match'),
            array('tv', 'whois.nic.tv', 'MAXCHARS:75'),
            array('tv.br', 'whois.nic.br', 'No match'),
            array('tw', 'whois.twnic.net', 'NO MATCH TIP'),
            array('tw.cn', 'whois.cnnic.net.cn', 'No entries found'),
            array('ua', 'whois.ripe.net', 'No entries found'),
            array('uk', 'whois.thnic.net', 'No match for'),
            array('uk.com', 'whois.nomination.net', 'No match for'),
            array('uk.net', 'whois.nomination.net', 'No match for'),
            array('us', 'whois.nic.us', 'Not found'),
            array('va', 'whois.ripe.net', 'No entries found'),
            array('vet.br', 'whois.nic.br', 'No match'),
            array('vg', 'whois.adamsnames.tc', 'is not registered'),
            array('wattle.id.au', 'whois.aunic.net', 'No Data Found'),
            array('web.tr', 'whois.nic.tr', 'Not found in database'),
            array('ws', 'whois.worldsite.ws', 'No match for'),
            array('xj.cn', 'whois.cnnic.net.cn', 'No entries found'),
            array('xz.cn', 'whois.cnnic.net.cn', 'No entries found'),
            array('yn.cn', 'whois.cnnic.net.cn', 'No entries found'),
            array('yu', 'whois.ripe.net', 'No entries found'),
            array('za', 'whois.frd.ac.za', 'No match for'),
            array('zj.cn', 'whois.cnnic.net.cn', 'No entries found'),
            array('zlg.br', 'whois.nic.br', 'No match'),
            array('co.nr', '', ''),
            array('co.nz', '', ''),
            array('tk', '', ''),
            array('in', '', ''),
            array('gov', '', ''),
            array('hr', '', ''),
            array('fm', 'n/a', 'n/a'),
            array('com.gr', '', ''),
            array('net.gr', '', ''),
            array('org.gr', '', ''),
            array('edu.gr', '', '')
        );
        return $urlInformations;
    }

}
