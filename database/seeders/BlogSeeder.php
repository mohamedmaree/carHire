<?php

namespace Database\Seeders;

use App\Models\Blog;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $blogs = [
            [
                'title' => ['en' => 'Best Road Trips in Sydney, Australia', 'ar' => 'أفضل رحلات الطرق في سيدني، أستراليا'],
                'description' => ['en' => 'There\'s something truly magical about hitting the open road with your loved ones and embarking on an adventure filled with laughter, discovery, and unforgettable memories. Sydney, Australia, offers some of the most breathtaking road trip destinations that are perfect for families seeking both excitement and relaxation.

Before setting off on your family road trip adventure, consider a few helpful tips to ensure a smooth and enjoyable experience:

1. **Plan ahead:** Research your routes, attractions, and accommodations in advance to avoid any last-minute surprises.

2. **Pack Essentials:** Create a checklist including snacks, water, first aid kit, and entertainment for the kids.

3. **Stay Flexible:** Don\'t be afraid to deviate from your itinerary if you discover something interesting along the way.

4. **Capture Memories:** Bring a camera to document the beautiful landscapes and family moments.

5. **Respect Nature:** Always follow the "leave no trace" principle and practice responsible tourism.

In conclusion, Sydney\'s surrounding areas offer an array of road trip options that cater to families seeking adventure, nature, and quality time together. From the charming countryside of Moss Vale Road to the rugged beauty of the Blue Mountains, each destination promises unique experiences that will create lasting memories for your family.', 'ar' => 'هناك شيء سحري حقاً في السير على الطريق المفتوح مع أحبائك والانطلاق في مغامرة مليئة بالضحك والاكتشاف والذكريات التي لا تُنسى. تقدم سيدني، أستراليا، بعض من أكثر الوجهات روعة لرحلات الطرق التي تعد مثالية للعائلات التي تبحث عن الإثارة والاسترخاء.

قبل الانطلاق في مغامرة رحلة الطريق العائلية، ضع في اعتبارك بعض النصائح المفيدة لضمان تجربة سلسة وممتعة:

1. **خطط مسبقاً:** ابحث عن طرقك ومعالمك الجذب والإقامة مسبقاً لتجنب أي مفاجآت في اللحظة الأخيرة.

2. **احزم الضروريات:** أنشئ قائمة مراجعة تشمل الوجبات الخفيفة والماء ومجموعة الإسعافات الأولية والترفيه للأطفال.

3. **كن مرناً:** لا تخف من الانحراف عن خط سير رحلتك إذا اكتشفت شيئاً مثيراً للاهتمام على طول الطريق.

4. **التقط الذكريات:** أحضر كاميرا لتوثيق المناظر الطبيعية الجميلة واللحظات العائلية.

5. **احترم الطبيعة:** اتبع دائماً مبدأ "لا تترك أثراً" ومارس السياحة المسؤولة.

في الختام، تقدم المناطق المحيطة بسيدني مجموعة من خيارات رحلات الطرق التي تلبي احتياجات العائلات التي تبحث عن المغامرة والطبيعة والوقت الجيد معاً. من الريف الساحر لطريق موس فالي إلى الجمال الوعر لجبال بلو، كل وجهة تعد بتجارب فريدة ستخلق ذكريات دائمة لعائلتك.'],
                'author' => ['en' => 'Travel Expert', 'ar' => 'خبير السفر'],
                'image' => null,
                'tags' => ['Travel', 'Sydney', 'Road Trip', 'Holiday'],
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'title' => ['en' => 'Essential Car Rental Tips for Your Next Trip', 'ar' => 'نصائح أساسية لتأجير السيارات لرحلتك القادمة'],
                'description' => ['en' => 'Renting a car can be one of the most convenient ways to explore a new destination at your own pace. However, there are several important factors to consider to ensure you get the best deal and avoid common pitfalls.

**Key Tips for Car Rental Success:**

1. **Book in Advance:** Reserve your vehicle early to secure better rates and availability.

2. **Compare Prices:** Check multiple rental companies to find the best deal.

3. **Read the Fine Print:** Understand insurance coverage, fuel policies, and mileage restrictions.

4. **Inspect the Vehicle:** Take photos of any existing damage before driving off the lot.

5. **Know Your Insurance:** Check if your personal auto insurance covers rental cars.

6. **Plan Your Route:** Familiarize yourself with local traffic laws and driving conditions.

7. **Return on Time:** Late returns can result in additional charges.

By following these guidelines, you\'ll be well-prepared for a smooth car rental experience that enhances your travel adventure.', 'ar' => 'يمكن أن يكون تأجير السيارة أحد أكثر الطرق ملاءمة لاستكشاف وجهة جديدة بالسرعة التي تناسبك. ومع ذلك، هناك عدة عوامل مهمة يجب مراعاتها لضمان الحصول على أفضل صفقة وتجنب المآزق الشائعة.

**نصائح أساسية لنجاح تأجير السيارة:**

1. **احجز مسبقاً:** احجز مركبتك مبكراً لضمان أسعار أفضل وتوفر المركبة.

2. **قارن الأسعار:** تحقق من عدة شركات تأجير للعثور على أفضل صفقة.

3. **اقرأ التفاصيل الدقيقة:** افهم تغطية التأمين وسياسات الوقود وقيود المسافة المقطوعة.

4. **افحص المركبة:** التقط صوراً لأي أضرار موجودة قبل القيادة خارج الموقع.

5. **اعرف تأمينك:** تحقق مما إذا كان تأمينك الشخصي للسيارة يغطي السيارات المؤجرة.

6. **خطط لطريقك:** تعرف على قوانين المرور المحلية وظروف القيادة.

7. **أعد في الوقت المحدد:** الإرجاع المتأخر قد يؤدي إلى رسوم إضافية.

باتباع هذه الإرشادات، ستكون مستعداً جيداً لتجربة تأجير سيارة سلسة تعزز مغامرة السفر الخاصة بك.'],
                'author' => ['en' => 'Car Rental Specialist', 'ar' => 'متخصص تأجير السيارات'],
                'image' => null,
                'tags' => ['Car Rental', 'Tips', 'Booking', 'Trip'],
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'title' => ['en' => 'Top 10 Must-Visit Destinations Near Sydney', 'ar' => 'أفضل 10 وجهات يجب زيارتها بالقرب من سيدني'],
                'description' => ['en' => 'Sydney serves as the perfect gateway to explore some of Australia\'s most stunning destinations. Whether you\'re looking for pristine beaches, lush national parks, or charming coastal towns, the areas surrounding Sydney offer incredible diversity and natural beauty.

**Our Top Recommendations:**

1. **Blue Mountains National Park** - World Heritage-listed wilderness with dramatic cliffs and waterfalls
2. **Royal National Park** - Australia\'s oldest national park with coastal walks and wildlife
3. **Hunter Valley** - Renowned wine region with picturesque vineyards and gourmet dining
4. **Port Stephens** - Perfect for dolphin watching and sand dune adventures
5. **Jervis Bay** - Home to some of the world\'s whitest sand beaches
6. **Kangaroo Valley** - Charming rural escape with historic villages and natural beauty
7. **Southern Highlands** - Cool climate region with gardens, galleries, and country charm
8. **Central Coast** - Family-friendly beaches and coastal attractions
9. **Wollongong** - Coastal city with beautiful beaches and the Sea Cliff Bridge
10. **Bathurst** - Historic gold rush town with motorsport heritage

Each destination offers unique experiences that showcase the incredible diversity of New South Wales. Plan your itinerary based on your interests, whether you prefer outdoor adventures, cultural experiences, or simply relaxing in beautiful surroundings.', 'ar' => 'تخدم سيدني كبوابة مثالية لاستكشاف بعض من أكثر الوجهات روعة في أستراليا. سواء كنت تبحث عن شواطئ نقية أو حدائق وطنية خصبة أو مدن ساحلية ساحرة، فإن المناطق المحيطة بسيدني تقدم تنوعاً لا يصدق وجمالاً طبيعياً.

**توصياتنا الأولى:**

1. **حديقة بلو ماونتينز الوطنية** - برية مدرجة في قائمة التراث العالمي مع منحدرات درامية وشلالات
2. **حديقة رويال الوطنية** - أقدم حديقة وطنية في أستراليا مع مشي ساحلي وحياة برية
3. **وادي هنتر** - منطقة نبيذ مشهورة مع كروم عنب خلابة وطعام فاخر
4. **بورت ستيفنز** - مثالي لمشاهدة الدلافين ومغامرات الكثبان الرملية
5. **خليج جيرفيس** - موطن لبعض من أكثر الشواطئ الرملية البيضاء في العالم
6. **وادي الكنغر** - هروب ريفي ساحر مع قرى تاريخية وجمال طبيعي
7. **المرتفعات الجنوبية** - منطقة مناخ بارد مع حدائق ومعارض وسحر ريفي
8. **الساحل المركزي** - شواطئ صديقة للعائلة ومعالم ساحلية
9. **ولونغونغ** - مدينة ساحلية مع شواطئ جميلة وجسر سيف كليف
10. **باثورست** - بلدة تاريخية لحمى الذهب مع تراث رياضة السيارات

كل وجهة تقدم تجارب فريدة تعرض التنوع المذهل لنيو ساوث ويلز. خطط لخط سير رحلتك بناءً على اهتماماتك، سواء كنت تفضل المغامرات الخارجية أو التجارب الثقافية أو مجرد الاسترخاء في محيط جميل.'],
                'author' => ['en' => 'Local Guide', 'ar' => 'دليل محلي'],
                'image' => null,
                'tags' => ['Sydney', 'Destinations', 'Travel', 'Holiday'],
                'is_active' => true,
                'sort_order' => 3,
            ],
        ];

        foreach ($blogs as $blogData) {
            Blog::create($blogData);
        }
    }
}