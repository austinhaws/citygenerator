<?php

use App\Http\Controllers\CityGen\Models\Table\TableCommodity;
use Illuminate\Database\Seeder;

require_once 'SeederUtil.php';

class CommoditiesTableSeeder extends Seeder
{
    private $data = [
            ['range' => 5, 'name' => 'Agate'],
            ['range' => 55, 'name' => 'Ale'],
            ['range' => 60, 'name' => 'Alexandrite'],
            ['range' => 80, 'name' => 'Alfalfa'],
            ['range' => 90, 'name' => 'Alpacas'],
            ['range' => 91, 'name' => 'Aluminum'],
            ['range' => 96, 'name' => 'Amber'],
            ['range' => 101, 'name' => 'Amethyst'],
            ['range' => 106, 'name' => 'Ametrine'],
            ['range' => 111, 'name' => 'Ammolite'],
            ['range' => 116, 'name' => 'Andalusite'],
            ['range' => 121, 'name' => 'Andesine'],
            ['range' => 131, 'name' => 'Anvils'],
            ['range' => 181, 'name' => 'Apples'],
            ['range' => 231, 'name' => 'Apricots'],
            ['range' => 236, 'name' => 'Aquamarine'],
            ['range' => 242, 'name' => 'Artichokes'],
            ['range' => 247, 'name' => 'Asparagus'],
            ['range' => 250, 'name' => 'Augite'],
            ['range' => 262, 'name' => 'Aventurine'],
            ['range' => 281, 'name' => 'Avocados'],
            ['range' => 320, 'name' => 'Bags'],
            ['range' => 322, 'name' => 'Bamboo'],
            ['range' => 340, 'name' => 'Bananas'],
            ['range' => 367, 'name' => 'Barley'],
            ['range' => 402, 'name' => 'Barrels'],
            ['range' => 442, 'name' => 'Baskets'],
            ['range' => 476, 'name' => 'Beans'],
            ['range' => 482, 'name' => 'Beech Nuts'],
            ['range' => 499, 'name' => 'Beads'],
            ['range' => 520, 'name' => 'Beets'],
            ['range' => 522, 'name' => 'Benitoite'],
            ['range' => 523, 'name' => 'Beryl'],
            ['range' => 540, 'name' => 'Blackberries'],
            ['range' => 576, 'name' => 'Blankets'],
            ['range' => 577, 'name' => 'Bloodstone'],
            ['range' => 582, 'name' => 'Blueberries'],
            ['range' => 600, 'name' => 'Bone'],
            ['range' => 625, 'name' => 'Books'],
            ['range' => 632, 'name' => 'Boysenberries'],
            ['range' => 665, 'name' => 'Bracelets'],
            ['range' => 669, 'name' => 'Breadfruit'],
            ['range' => 681, 'name' => 'Bridles'],
            ['range' => 690, 'name' => 'Broccoli'],
            ['range' => 693, 'name' => 'Bronze'],
            ['range' => 720, 'name' => 'Buckets'],
            ['range' => 721, 'name' => 'Burdocks'],
            ['range' => 722, 'name' => 'Calcite'],
            ['range' => 733, 'name' => 'Camels'],
            ['range' => 744, 'name' => 'Canaries'],
            ['range' => 755, 'name' => 'Canoes'],
            ['range' => 756, 'name' => 'Carnelian'],
            ['range' => 770, 'name' => 'Carrots'],
            ['range' => 775, 'name' => 'Cats'],
            ['range' => 777, 'name' => 'Cat\'s Eye'],
            ['range' => 787, 'name' => 'Cauldrons'],
            ['range' => 792, 'name' => 'Cauliflower'],
            ['range' => 802, 'name' => 'Celery'],
            ['range' => 803, 'name' => 'Chalcedony'],
            ['range' => 810, 'name' => 'Charcoal'],
            ['range' => 823, 'name' => 'Cherries'],
            ['range' => 875, 'name' => 'Chickens'],
            ['range' => 877, 'name' => 'Chili Peppers'],
            ['range' => 878, 'name' => 'Chlorite'],
            ['range' => 879, 'name' => 'Chrome'],
            ['range' => 880, 'name' => 'Chrysocolla'],
            ['range' => 881, 'name' => 'Chrysoprase'],
            ['range' => 899, 'name' => 'Cinnamon'],
            ['range' => 900, 'name' => 'Citrine'],
            ['range' => 935, 'name' => 'Clay'],
            ['range' => 936, 'name' => 'Clinohumite'],
            ['range' => 992, 'name' => 'Cloth'],
            ['range' => 1032, 'name' => 'Clothing'],
            ['range' => 1047, 'name' => 'Cloves'],
            ['range' => 1048, 'name' => 'Cockroaches'],
            ['range' => 1053, 'name' => 'Coconuts'],
            ['range' => 1082, 'name' => 'Copper'],
            ['range' => 1101, 'name' => 'Coral'],
            ['range' => 1151, 'name' => 'Cord'],
            ['range' => 1202, 'name' => 'Corn'],
            ['range' => 1203, 'name' => 'Corundum'],
            ['range' => 1254, 'name' => 'Cows'],
            ['range' => 1264, 'name' => 'Cranberries'],
            ['range' => 1270, 'name' => 'Cucumbers'],
            ['range' => 1271, 'name' => 'Cymophane'],
            ['range' => 1272, 'name' => 'Danburite'],
            ['range' => 1302, 'name' => 'Deer'],
            ['range' => 1303, 'name' => 'Demantoid'],
            ['range' => 1304, 'name' => 'Diamond'],
            ['range' => 1350, 'name' => 'Dogs'],
            ['range' => 1373, 'name' => 'Donkeys'],
            ['range' => 1402, 'name' => 'Doves'],
            ['range' => 1436, 'name' => 'Ducks'],
            ['range' => 1437, 'name' => 'Dumortierite'],
            ['range' => 1462, 'name' => 'Dye'],
            ['range' => 1486, 'name' => 'Earrings'],
            ['range' => 1491, 'name' => 'Eggplants'],
            ['range' => 1522, 'name' => 'Elephants'],
            ['range' => 1523, 'name' => 'Emerald'],
            ['range' => 1524, 'name' => 'Enstatite'],
            ['range' => 1525, 'name' => 'Epidote'],
            ['range' => 1526, 'name' => 'Euclase'],
            ['range' => 1527, 'name' => 'Feldspar'],
            ['range' => 1542, 'name' => 'Felt'],
            ['range' => 1547, 'name' => 'Ferrets'],
            ['range' => 1560, 'name' => 'Fertilizer'],
            ['range' => 1573, 'name' => 'Figs'],
            ['range' => 1634, 'name' => 'Fish'],
            ['range' => 1641, 'name' => 'Flax'],
            ['range' => 1656, 'name' => 'Fleece'],
            ['range' => 1706, 'name' => 'Flour'],
            ['range' => 1718, 'name' => 'Foxes'],
            ['range' => 1719, 'name' => 'Galena'],
            ['range' => 1720, 'name' => 'Garnet'],
            ['range' => 1721, 'name' => 'Gaspeite'],
            ['range' => 1734, 'name' => 'Geese'],
            ['range' => 1737, 'name' => 'Ginger'],
            ['range' => 1764, 'name' => 'Glass'],
            ['range' => 1776, 'name' => 'Goats'],
            ['range' => 1779, 'name' => 'Gold'],
            ['range' => 1782, 'name' => 'Goldfish'],
            ['range' => 1803, 'name' => 'Gooseberries'],
            ['range' => 1828, 'name' => 'Gourds'],
            ['range' => 1833, 'name' => 'Grapefruits'],
            ['range' => 1843, 'name' => 'Grapes'],
            ['range' => 1844, 'name' => 'Graphite'],
            ['range' => 1858, 'name' => 'Green bean'],
            ['range' => 1859, 'name' => 'Grossular'],
            ['range' => 1865, 'name' => 'Guava'],
            ['range' => 1873, 'name' => 'Guinea pig'],
            ['range' => 1898, 'name' => 'Gunpowder'],
            ['range' => 1899, 'name' => 'Halite'],
            ['range' => 1914, 'name' => 'Hazelnuts'],
            ['range' => 1915, 'name' => 'Heliodor'],
            ['range' => 1916, 'name' => 'Hemimorphite'],
            ['range' => 1917, 'name' => 'Hessonite'],
            ['range' => 1955, 'name' => 'Hide'],
            ['range' => 1963, 'name' => 'Honey bees'],
            ['range' => 1964, 'name' => 'Hornblende'],
            ['range' => 2017, 'name' => 'Horses'],
            ['range' => 2018, 'name' => 'Humatite'],
            ['range' => 2019, 'name' => 'Indigo'],
            ['range' => 2020, 'name' => 'Iolite'],
            ['range' => 2036, 'name' => 'Iron'],
            ['range' => 2043, 'name' => 'Iron hoops'],
            ['range' => 2045, 'name' => 'Jade'],
            ['range' => 2047, 'name' => 'Jasper'],
            ['range' => 2048, 'name' => 'Kale'],
            ['range' => 2049, 'name' => 'Kaolin'],
            ['range' => 2052, 'name' => 'Kiwis'],
            ['range' => 2053, 'name' => 'Kuznite'],
            ['range' => 2054, 'name' => 'Kyanite'],
            ['range' => 2055, 'name' => 'Labradorite'],
            ['range' => 2056, 'name' => 'Lapis Lazuli'],
            ['range' => 2065, 'name' => 'Lead'],
            ['range' => 2115, 'name' => 'Leather'],
            ['range' => 2124, 'name' => 'Leeks'],
            ['range' => 2134, 'name' => 'Lemons'],
            ['range' => 2149, 'name' => 'Lettuce'],
            ['range' => 2154, 'name' => 'Limes'],
            ['range' => 2163, 'name' => 'Limestone'],
            ['range' => 2164, 'name' => 'Limonite'],
            ['range' => 2165, 'name' => 'Linen'],
            ['range' => 2168, 'name' => 'Llamas'],
            ['range' => 2171, 'name' => 'Locks'],
            ['range' => 2172, 'name' => 'Magnesium'],
            ['range' => 2173, 'name' => 'Magnetite'],
            ['range' => 2174, 'name' => 'Malachite'],
            ['range' => 2178, 'name' => 'Mandarin Oranges'],
            ['range' => 2179, 'name' => 'Marcasite'],
            ['range' => 2184, 'name' => 'Melons'],
            ['range' => 2185, 'name' => 'Meteorite'],
            ['range' => 2186, 'name' => 'Mica'],
            ['range' => 2187, 'name' => 'Minks'],
            ['range' => 2188, 'name' => 'Moonstone'],
            ['range' => 2189, 'name' => 'Morganite'],
            ['range' => 2193, 'name' => 'Mulberries'],
            ['range' => 2208, 'name' => 'Musical Instruments'],
            ['range' => 2225, 'name' => 'Nails'],
            ['range' => 2244, 'name' => 'Necklaces'],
            ['range' => 2245, 'name' => 'Nickel'],
            ['range' => 2248, 'name' => 'Oak Acorns'],
            ['range' => 2249, 'name' => 'Obsidian'],
            ['range' => 2256, 'name' => 'Oil'],
            ['range' => 2257, 'name' => 'Okra'],
            ['range' => 2265, 'name' => 'Olives'],
            ['range' => 2266, 'name' => 'Olivine'],
            ['range' => 2274, 'name' => 'Onions'],
            ['range' => 2275, 'name' => 'Onyx'],
            ['range' => 2276, 'name' => 'Opal'],
            ['range' => 2285, 'name' => 'Oranges'],
            ['range' => 2310, 'name' => 'Ox'],
            ['range' => 2315, 'name' => 'Parsnips'],
            ['range' => 2336, 'name' => 'Peaches'],
            ['range' => 2345, 'name' => 'Peanuts'],
            ['range' => 2353, 'name' => 'Pearl'],
            ['range' => 2374, 'name' => 'Pears'],
            ['range' => 2385, 'name' => 'Peas'],
            ['range' => 2396, 'name' => 'Pepper'],
            ['range' => 2397, 'name' => 'Periclase'],
            ['range' => 2398, 'name' => 'Peridot'],
            ['range' => 2415, 'name' => 'Pigeons'],
            ['range' => 2439, 'name' => 'Pigs'],
            ['range' => 2445, 'name' => 'Pineapples'],
            ['range' => 2446, 'name' => 'Platinum'],
            ['range' => 2455, 'name' => 'Plums'],
            ['range' => 2468, 'name' => 'Pomegranates'],
            ['range' => 2501, 'name' => 'Potatoes'],
            ['range' => 2525, 'name' => 'Pumpkins'],
            ['range' => 2526, 'name' => 'Pyrite'],
            ['range' => 2527, 'name' => 'Pyrite'],
            ['range' => 2528, 'name' => 'Quail'],
            ['range' => 2529, 'name' => 'Quartz'],
            ['range' => 2545, 'name' => 'Rabbits'],
            ['range' => 2546, 'name' => 'Radishes'],
            ['range' => 2547, 'name' => 'Raspberries'],
            ['range' => 2563, 'name' => 'Rats'],
            ['range' => 2564, 'name' => 'Reducrrants'],
            ['range' => 2583, 'name' => 'Reindeer'],
            ['range' => 2584, 'name' => 'Rhodolite'],
            ['range' => 2595, 'name' => 'Rhubarb'],
            ['range' => 2613, 'name' => 'Rings'],
            ['range' => 2614, 'name' => 'Rose Quartz'],
            ['range' => 2615, 'name' => 'Rosehips'],
            ['range' => 2616, 'name' => 'Ruby'],
            ['range' => 2665, 'name' => 'Saddles'],
            ['range' => 2666, 'name' => 'Saffrons'],
            ['range' => 2691, 'name' => 'Salt'],
            ['range' => 2710, 'name' => 'Sand'],
            ['range' => 2711, 'name' => 'Sapphire'],
            ['range' => 2712, 'name' => 'Sardonyx'],
            ['range' => 2716, 'name' => 'Saskatoon Berries'],
            ['range' => 2738, 'name' => 'Scabbards'],
            ['range' => 2739, 'name' => 'Shallots'],
            ['range' => 2791, 'name' => 'Sheep'],
            ['range' => 2815, 'name' => 'Shields'],
            ['range' => 2837, 'name' => 'Silk'],
            ['range' => 2855, 'name' => 'Silkworms'],
            ['range' => 2863, 'name' => 'Silver'],
            ['range' => 2881, 'name' => 'Slaves'],
            ['range' => 2898, 'name' => 'Snakes'],
            ['range' => 2911, 'name' => 'Soybeans'],
            ['range' => 2963, 'name' => 'Spices'],
            ['range' => 2979, 'name' => 'Spinach'],
            ['range' => 2980, 'name' => 'Spinel'],
            ['range' => 2995, 'name' => 'Squash'],
            ['range' => 3029, 'name' => 'Steel'],
            ['range' => 3066, 'name' => 'Stone'],
            ['range' => 3089, 'name' => 'Strawberries'],
            ['range' => 3090, 'name' => 'Sugilite'],
            ['range' => 3091, 'name' => 'Sulphur'],
            ['range' => 3096, 'name' => 'Sunflower Seeds'],
            ['range' => 3109, 'name' => 'Swans'],
            ['range' => 3132, 'name' => 'Swords'],
            ['range' => 3133, 'name' => 'Tanzanite'],
            ['range' => 3165, 'name' => 'Tapestries'],
            ['range' => 3166, 'name' => 'Tiger\'s Eye'],
            ['range' => 3184, 'name' => 'Tin'],
            ['range' => 3251, 'name' => 'Tobacco'],
            ['range' => 3285, 'name' => 'Tomatoes'],
            ['range' => 3287, 'name' => 'Topaz'],
            ['range' => 3288, 'name' => 'Tourmaline'],
            ['range' => 3296, 'name' => 'Tubs'],
            ['range' => 3308, 'name' => 'Turkeys'],
            ['range' => 3318, 'name' => 'Turnips'],
            ['range' => 3319, 'name' => 'Turquoise'],
            ['range' => 3325, 'name' => 'Walnuts'],
            ['range' => 3328, 'name' => 'Water Buffalo'],
            ['range' => 3340, 'name' => 'Watermelons'],
            ['range' => 3396, 'name' => 'Wheat'],
            ['range' => 3418, 'name' => 'Whetstones'],
            ['range' => 3473, 'name' => 'Wine'],
            ['range' => 3531, 'name' => 'Wood'],
            ['range' => 3591, 'name' => 'Wool'],
            ['range' => 3611, 'name' => 'Yaks'],
            ['range' => 3644, 'name' => 'Yams'],
            ['range' => 3697, 'name' => 'Yarn'],
            ['range' => 3698, 'name' => 'Zebus'],
            ['range' => 3699, 'name' => 'Zinc'],
            ['range' => 3700, 'name' => 'Zircon'],
        ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        array_walk($this->data, function ($data) {
            (new TableCommodity($data))->save();
        });
    }
}