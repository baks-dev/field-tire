<?php
/*
 *  Copyright 2023.  Baks.dev <admin@baks.dev>
 *  
 *  Permission is hereby granted, free of charge, to any person obtaining a copy
 *  of this software and associated documentation files (the "Software"), to deal
 *  in the Software without restriction, including without limitation the rights
 *  to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 *  copies of the Software, and to permit persons to whom the Software is furnished
 *  to do so, subject to the following conditions:
 *  
 *  The above copyright notice and this permission notice shall be included in all
 *  copies or substantial portions of the Software.
 *  
 *  THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 *  IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 *  FITNESS FOR A PARTICULAR PURPOSE AND NON INFRINGEMENT. IN NO EVENT SHALL THE
 *  AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 *  LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 *  OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 *  THE SOFTWARE.
 */

namespace BaksDev\Field\Tire\Brand\Type;


enum TireBrandEnum : string
{
	case Altenzo = 'Altenzo';
	case Amtel = 'Amtel';
	case Aosen = 'Aosen';
	case Aplus = 'Aplus';
	case Arivo = 'Arivo';
	case Auplus = 'Auplus';
	case Austone = 'Austone';
	case Bars = 'Bars';
	case Barum = 'Barum';
	case BFGoodrich = 'BFGoodrich';
	case Blacklion = 'Blacklion';
	case Boto = 'Boto';
	case Bridgestone = 'Bridgestone';
	case Cachland = 'Cachland';
	case Centara = 'Centara';
	case Charmhoo = 'Charmhoo';
	case Compasal = 'Compasal';
	case Continental = 'Continental';
	case Contyre = 'Contyre';
	case Cordiant = 'Cordiant';
	case CrossLeader = 'CrossLeader';
	case CST = 'CST';
	case Davanti = 'Davanti';
	case Delinte = 'Delinte';
	case Delmax = 'Delmax';
	case Dmack = 'Dmack';
	case Doublecoin = 'Doublecoin';
	case Doublestar = 'Doublestar';
	case Dunlop = 'Dunlop';
	case Duraturn = 'Duraturn';
	case Durun = 'Durun';
	case Dynamo = 'Dynamo';
	case Evergreen = 'Evergreen';
	case Falken = 'Falken';
	case Farroad = 'Farroad';
	case Firemax = 'Firemax';
	case Firestone = 'Firestone';
	case Foman = 'Foman';
	case Formula = 'Formula';
	case Fortuna = 'Fortuna';
	case Fortune = 'Fortune';
	case GeneralTire = 'GeneralTire';
	case Gislaved = 'Gislaved';
	case GoForm = 'GoForm';
	case Goldstone = 'Goldstone';
	case Goodride = 'Goodride';
	case Goodyear = 'Goodyear';
	case Greentrac = 'Greentrac';
	case Grenlander = 'Grenlander';
	case Gripmax = 'Gripmax';
	case GTRadial = 'GTRadial';
	case Habilead = 'Habilead';
	case Haida = 'Haida';
	case Hankook = 'Hankook';
	case Headway = 'Headway';
	case Hemisphere = 'Hemisphere';
	case Herovic = 'Herovic';
	case Hifly = 'Hifly';
	case Horizon = 'Horizon';
	case iLINK = 'iLINK';
	case Imperial = 'Imperial';
	case Jinyu = 'Jinyu';
	case Joyroad = 'Joyroad';
	case Kapsen = 'Kapsen';
	case Kenda = 'Kenda';
	case Kinforest = 'Kinforest';
	case Kingstar = 'Kingstar';
	case Kleber = 'Kleber';
	case Kormoran = 'Kormoran';
	case Kumho = 'Kumho';
	case Landsail = 'Landsail';
	case Lanvigator = 'Lanvigator';
	case Lassa = 'Lassa';
	case Laufenn = 'Laufenn';
	case Leao = 'Leao';
	case LingLong = 'LingLong';
	case Marshal = 'Marshal';
	case Matador = 'Matador';
	case Maxxis = 'Maxxis';
	case Mazzini = 'Mazzini';
	case Michelin = 'Michelin';
	case MickeyThompson = 'MickeyThompson';
	case Mileking = 'Mileking';
	case Minerva = 'Minerva';
	case Mirage = 'Mirage';
	case Nankang = 'Nankang';
	case Nexen = 'Nexen';
	case Nitto = 'Nitto';
	case Nokian = 'Nokian';
	case Nordman = 'Nordman';
	case Nortec = 'Nortec';
	case Onyx = 'Onyx';
	case Orium = 'Orium';
	case Ovation = 'Ovation';
	case Pace = 'Pace';
	case Petlas = 'Petlas';
	case Pirelli = 'Pirelli';
	case Powertrac = 'Powertrac';
	case Premiorri = 'Premiorri';
	case Presa = 'Presa';
	case Rapid = 'Rapid';
	case Razi = 'Razi';
	case Roadcruza = 'Roadcruza';
	case RoadMarch = 'RoadMarch';
	case Roadstone = 'Roadstone';
	case RoadX = 'RoadX';
	case Rotalla = 'Rotalla';
	case RoyalBlack = 'RoyalBlack';
	case Saferich = 'Saferich';
	case Sailun = 'Sailun';
	case Satoya = 'Satoya';
	case Sava = 'Sava';
	case Solideal = 'Solideal';
	case Starmaxx = 'Starmaxx';
	case Sunfull = 'Sunfull';
	case Sunny = 'Sunny';
	case Sunwide = 'Sunwide';
	case Taurus = 'Taurus';
	case Tigar = 'Tigar';
	case Toledo = 'Toledo';
	case Torque = 'Torque';
	case Tourador = 'Tourador';
	case Toyo = 'Toyo';
	case Tracmax = 'Tracmax';
	case TriAce = 'TriAce';
	case Triangle = 'Triangle';
	case Tunga = 'Tunga';
	case Uniroyal = 'Uniroyal';
	case Viatti = 'Viatti';
	case Vittos = 'Vittos';
	case Vredestein = 'Vredestein';
	case Waterfall = 'Waterfall';
	case WestLake = 'WestLake';
	case Windforce = 'Windforce';
	case Winrun = 'Winrun';
	case Yokohama = 'Yokohama';
	case Zeetex = 'Zeetex';
	case Zeta = 'Zeta';
	case Barnaul = 'Barnaul';
	case Belshina = 'Belshina';
	case Voltaire = 'Voltaire';
	case Kama = 'Kama';
	case Kirov = 'Kirov';
	case Rosava = 'Rosava';
}
