<?php

namespace App\Http\Controllers\CityGen\Tables;

use App\Http\Common\Tables\BaseTable;
use App\Http\Controllers\CityGen\Constants\Building;


class BuildingSubTypesTable extends BaseTable
{

    function getTable()
    {
        return array(
            Building::WORKSHOP => array(
                87 => 'Cobblers',
                174 => "Furniture Makers",
                240 => "Furriers",
                293 => "Weavers",
                335 => "Basket Makers",
                377 => "Carpenters",
                419 => "Paper/Parchment Makers",
                461 => "Potters",
                499 => "Wheelwrights",
                534 => "Jewelers",
                564 => "Masons",
                594 => "Bakers",
                620 => "Soap Makers",
                641 => "Chandlers",
                661 => "Coopers",
                680 => "Pastry Makers",
                695 => "Scabbard Makers",
                710 => "Silversmiths",
                723 => "Saddlers an Spurriers",
                735 => "Purse Makers",
                747 => "Blacksmiths",
                759 => "Goldsmiths",
                765 => "Toy Makers",
                771 => "Artists",
                775 => "Leather Workers",
                780 => "Rope Makers",
                782 => "Tanners",
                793 => "Buckle Makers",
                803 => "Cutlers",
                813 => "Fullers",
                822 => "Harness Makers",
                831 => "Painters",
                849 => "Woodcarvers",
                858 => "Glass Makers",
                866 => "Woodcarvers",
                873 => "Glass Makers",
                880 => "Instrument Makers",
                887 => "Locksmiths",
                894 => "Rug Makers",
                901 => "Sculptors",
                907 => "Bleachers",
                913 => "Ship Makers",
                919 => "Bookbinders",
                925 => "Bowyer/Fletchers",
                931 => "Brewers",
                937 => "Glove Makers",
                943 => "Vintner",
                948 => "Girdlers",
                953 => "Skinners",
                958 => "Armorers",
                963 => "Weapon Smiths",
                967 => "Distillers",
                971 => "Illuminators",
                975 => "Perfumer",
                979 => "Tilers",
                983 => "Potion Makers",
                986 => "Clock Makers",
                989 => "Taxidermists",
                992 => "Vestment Makers",
                994 => "Alchemists",
                996 => "Bell Makers",
                998 => "Dye Makers",
                1000 => "Inventors",
            ),
            Building::SHOP => array(
                97 => "Clothiers, Used",
                194 => "Grocers",
                270 => "Dairy Sellers",
                346 => "Launderers",
                422 => "Prostitutes",
                498 => "Furriers",
                558 => "Tailors",
                607 => "Barbers",
                656 => "Drapers",
                705 => "Flower Sellers",
                745 => "Jewelers",
                768 => "Mercers",
                790 => "Engravers",
                812 => "Pawnbroker",
                832 => "Haberdashers",
                852 => "Wine Merchants",
                868 => "Tinkers",
                883 => "Butchers",
                898 => "Fishmongers",
                911 => "Wool Merchants",
                923 => "Beer Merchants",
                935 => "Herbalists",
                947 => "Spice Merchants",
                957 => "Wood Sellers",
                965 => "Brothel Keepers",
                973 => "Hay Merchants",
                979 => "Booksellers",
                985 => "Religious Souvenir Sellers",
                989 => "Dentists",
                993 => "Navel Outfitters",
                996 => "Grain Merchants",
                999 => "Tobacco Merchants",
                1000 => "Magic Merchants",
            ),
            Building::OFFICE => array(
                200 => "Livestock Merchants",
                360 => "Carpenters",
                474 => "Masons",
                546 => "Pawnbroker",
                611 => "Wine Merchants",
                661 => "Doctors, Unlicensed",
                706 => "Wool Merchants",
                746 => "Beer Merchants",
                786 => "Spice Merchants",
                815 => "Doctors, Licensed",
                842 => "Copyists",
                864 => "Moneychangers",
                884 => "Sage/Scholar",
                902 => "Advocates (Lawyers)",
                918 => "Historians",
                931 => "Engineers",
                941 => "Architects",
                951 => "Astrologers",
                961 => "Grain Merchants",
                971 => "Tobacco Merchants",
                980 => "Bankers",
                989 => "Slavers",
                997 => "Cartographers",
                1000 => "Magic Merchants",
            ),
        );
    }
}
