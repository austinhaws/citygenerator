<?php

namespace App\Http\Controllers\CityGen\Tables;

class GuildsTable extends BaseTable
{
    function getTable()
    {
        return array(
            'Architects & Engineers' => array(
                'Architects',
                'Engineers',
            ),
            'Armorers & Locksmiths' => array(
                'Armorers',
                'Locksmiths',
            ),
            'Artists' => array(
                'Artists',
                'Painters',
                'Satirists',
                'Sculptors',
                'Writers',
            ),
            'Bakers' => array(
                'Bakers',
                'Pastry Makers',
            ),
            'Bookbinders & Paper Makers' => array(
                'Bookbinders',
                'Booksellers',
                'Paper/Parchment Makers',
            ),
            'Bowyers & Fletchers' => array(
                'Bowyer/Fletchers',
            ),
            'Brewers, Distillers, & Vintners' => array(
                'Brewers',
                'Distillers',
                'Vintner',
            ),
            'Brothel Keepers' => array(
                'Bathers',
                'Brothel Keepers',
            ),
            'Builders' => array(
                'Carpenters',
                'Plasterers',
                'Roofers',
            ),
            'Butchers' => array(
                'Butchers',
            ),
            'Casters' => array(
                'Bell Makers',
                'Engravers',
                'Goldsmiths',
                'Silversmiths',
            ),
            'Chandliers' => array(
                'Chandlers',
                'Soap Makers',
            ),
            'Clay & Stone Workers' => array(
                'Bricklayers',
                'Masons',
                'Potters',
                'Tilers',
            ),
            'Clerks & Scribes' => array(
                'Copyists',
                'Illuminators',
            ),
            'Clothing & Accessories' => array(
                'Girdlers',
                'Glove Makers',
                'Mercers',
                'Perfumer',
                'Purse Makers',
                'Tailors',
                'Vestment Makers',
            ),
            'Cobblers' => array(
                'Cobblers',
            ),
            'Coopers' => array(
                'Coopers',
            ),
            'Cord Wainers' => array(
                'Leather Workers',
            ),
            'Dyers & Weavers' => array(
                'Bleachers',
                'Drapers',
                'Dye Makers',
                'Fullers',
                'Rug Makers',
                'Weavers',
            ),
            'Financial Transactions' => array(
                'Bankers',
                'Moneychangers',
                'Pawnbroker',
                'Tax Collectors',
            ),
            'Fishmongers' => array(
                'Fishers',
                'Fishmongers',
            ),
            'Forgers & Smiths' => array(
                'Blacksmiths',
                'Buckle Makers',
                'Cutlers',
                'Scabbard Makers',
                'Weapon Smiths',
            ),
            'Furriers' => array(
                'Furriers',
            ),
            'Glass Workers' => array(
                'Glass Makers',
                'Glaziers',
            ),
            'Harness Makers & Saddlers' => array(
                'Harness Makers',
                'Saddlers and Spurriers',
            ),
            'Hostliers' => array(
                'Inn Keepers',
                'Restaurantiers',
                'Tavern Keepers',
            ),
            'Jewelers' => array(
                'Goldsmiths',
                'Jewelers',
                'Silversmiths',
            ),
            'Launderers' => array(
                'Launderers',
            ),
            'Magic' => array(
                'Alchemists',
                'Astrologers',
                'Magic Merchants',
                'Potion Makers',
            ),
            'Map Makers & Surveyors' => array(
                'Cartographers',
            ),
            'Mariners' => array(
                'Navigators/Pathfinders',
                'Navel Outfitters',
                'Rope Makers',
            ),
            'Medical' => array(
                'Barbers',
                'Dentists',
                'Doctors, Unlicensed',
                'Herbalists',
                'Midwives',
            ),
            'Merchants' => array(
                'Beer Merchants',
                'Booksellers',
                'Clothiers, Used',
                'Dairy sellers',
                'Flower Sellers',
                'Grain Merchants',
                'Grocers',
                'Haberdashers',
                'Hay Merchants',
                'Livestock merchants',
                'Magic Merchants',
                'Millers',
                'Perfumer',
                'Religious Souvenir Sellers',
                'Slavers',
                'Spice Merchants',
                'Tobacco merchants',
                'Wine Merchants',
                'Wood Sellers',
                'Wool Merchants',
            ),
            'Music & Performers' => array(
                'Acrobats, Tumblers',
                'Instrument Makers',
                'Jesters',
                'Jongleurs',
                'Minstrels',
                'Storytellers',
            ),
            'Professional Guilds' => array(
                'Advocates (lawyers)',
                'Doctors, Licensed',
                'Judges',
                'Librarians',
                'Professors',
                'Teachers',
            ),
            'Scholastic' => array(
                'Historians',
                'Professors',
                'Sage/scholar',
            ),
            'Shipwrights' => array(
                'Ship Makers',
            ),
            'Skinners & Tanners' => array(
                'Leather Workers',
                'Skinners',
                'Tanners',
                'Taxidermists',
            ),
            'Stable Keepers' => array(
                'Grooms',
            ),
            'Tinkerers' => array(
                'Clock Makers',
                'Inventors',
                'Toy Makers',
            ),
            'Water Men' => array(
                'Water Carriers',
            ),
            'Wheel Wrights' => array(
                'Wheelwrights',
            ),
            'Wicker Workers' => array(
                'Basket Makers',
                'Furniture Makers',
            ),
            'Wood Workers' => array(
                'Furniture Makers',
                'Woodcarvers',
            ),
        );
    }
}
