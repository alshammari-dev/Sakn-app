@extends('layouts.sakn')

@section('title', 'عن الشركة')

@section('content')
    <section class="section section-alt" style="padding: 100px 0; background: linear-gradient(to left, #f9fafb 0%, #ffffff 100%);">
        <div class="container">
            <div style="display: flex; align-items: center; gap: 80px; flex-wrap: wrap;">
                <div style="flex: 1; min-width: 300px;">
                    <p style="color: var(--sakn-gold, #BC9355); font-weight: 800; font-size: 1.2rem; margin-bottom: 15px; letter-spacing: 1px;">نبني المستقبل</p>
                    <h1 style="font-size: 3.5rem; font-weight: 900; color: var(--sakn-green, #2F4F3E); margin-bottom: 30px; line-height: 1.2;">شركة سكن للتطوير العقاري</h1>
                    <p style="font-size: 1.15rem; color: #555; margin-bottom: 20px; line-height: 1.8;">نحن لا نبني مجرد مبانٍ، بل نصنع مجتمعات سكنية متكاملة وأيقونات معمارية ترتقي بمفهوم الرفاهية. تأسست "سكن" برؤية طموحة لتقديم مشاريع عقارية استثنائية تضع جودة الحياة في المقام الأول.</p>
                    <p style="font-size: 1.15rem; color: #555; line-height: 1.8;">ننفرد بتطوير مشاريعنا الخاصة وبيعها مباشرة لعملائنا، مما يضمن أعلى معايير الجودة، الشفافية المطلقة، والقيمة الاستثمارية المستدامة بعيداً عن وسطاء السوق.</p>
                </div>
                <div style="flex: 1; min-width: 300px; position: relative;">
                    <div style="position: absolute; top: -20px; left: -20px; width: 100%; height: 100%; border: 4px solid var(--sakn-gold, #BC9355); z-index: 0;"></div>
                    <img src="https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&q=80&w=800" alt="Sakn Development" style="width: 100%; height: auto; display: block; position: relative; z-index: 1; box-shadow: 0 20px 40px rgba(0,0,0,0.2);">
                </div>
            </div>
        </div>
    </section>

    <section class="section" style="padding: 100px 0;">
        <div class="container">
            <div style="text-align: center; margin-bottom: 60px;">
                <h2 style="font-size: 2.5rem; color: var(--sakn-green, #2F4F3E); font-weight: 800;">ركائز التميز في سكن</h2>
            </div>
            <div class="card-grid" style="grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 40px;">
                <div style="text-align: center; padding: 50px 30px; background: white; box-shadow: 0 10px 30px rgba(0,0,0,0.05); border-radius: 8px; transition: transform 0.3s;">
                    <div style="width: 80px; height: 80px; background: #fcf8f2; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 25px;">
                        <i class="bi bi-buildings" style="font-size: 35px; color: var(--sakn-gold, #BC9355);"></i>
                    </div>
                    <h3 style="margin-top: 20px; color: var(--sakn-green, #2F4F3E); font-weight: 800;">جودة التنفيذ</h3>
                    <p style="margin-top: 15px; color: var(--text-muted); line-height: 1.6;">نستخدم أحدث التقنيات وأفضل المواد في بناء مشاريعنا لضمان المتانة والعمر الافتراضي الطويل.</p>
                </div>
                <div style="text-align: center; padding: 50px 30px; background: white; box-shadow: 0 10px 30px rgba(0,0,0,0.05); border-radius: 8px; transition: transform 0.3s;">
                    <div style="width: 80px; height: 80px; background: #fcf8f2; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 25px;">
                        <i class="bi bi-gem" style="font-size: 35px; color: var(--sakn-gold, #BC9355);"></i>
                    </div>
                    <h3 style="margin-top: 20px; color: var(--sakn-green, #2F4F3E); font-weight: 800;">التصاميم الفاخرة</h3>
                    <p style="margin-top: 15px; color: var(--text-muted); line-height: 1.6;">تصاميم معمارية فريدة تجمع بين الأصالة والحداثة لتلبي ذوق النخبة وتوفر أقصى درجات الراحة.</p>
                </div>
                <div style="text-align: center; padding: 50px 30px; background: white; box-shadow: 0 10px 30px rgba(0,0,0,0.05); border-radius: 8px; transition: transform 0.3s;">
                    <div style="width: 80px; height: 80px; background: #fcf8f2; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 25px;">
                        <i class="bi bi-graph-up-arrow" style="font-size: 35px; color: var(--sakn-gold, #BC9355);"></i>
                    </div>
                    <h3 style="margin-top: 20px; color: var(--sakn-green, #2F4F3E); font-weight: 800;">القيمة الاستثمارية</h3>
                    <p style="margin-top: 15px; color: var(--text-muted); line-height: 1.6;">اختيارنا الاستراتيجي لمواقع المشاريع يضمن نمواً مستمراً في قيمة عقارك وعوائد استثمارية مجزية.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="section" style="background: var(--sakn-green, #2F4F3E); color: white; padding: 80px 0;">
        <div class="container">
            <div style="max-width: 1100px; margin: 0 auto; background: white; border-radius: 12px; overflow: hidden; box-shadow: 0 20px 50px rgba(0,0,0,0.2); display: flex; flex-wrap: wrap;">
                <div style="flex: 1; min-width: 300px; padding: 60px; background: #14261C; color: white;">
                    <h2 style="margin-bottom: 20px; font-weight: 800; font-size: 2rem;">الإدارة العامة</h2>
                    <p style="opacity: 0.8; margin-bottom: 50px; font-size: 1.1rem;">فريق مبيعاتنا متاح للرد على كافة استفساراتكم وترتيب زيارات لمواقع مشاريعنا.</p>
                    
                    <div style="margin-bottom: 35px; display: flex; align-items: flex-start; gap: 15px;">
                        <i class="bi bi-geo-alt-fill" style="font-size: 24px; color: var(--sakn-gold, #BC9355);"></i>
                        <div>
                            <h4 style="color: var(--sakn-gold, #BC9355); margin-bottom: 5px; font-weight: 700;">المقر الرئيسي</h4>
                            <p style="color: #e0d8c3;">المملكة العربية السعودية، الرياض، طريق الملك فهد</p>
                        </div>
                    </div>
                    
                    <div style="margin-bottom: 35px; display: flex; align-items: flex-start; gap: 15px;">
                        <i class="bi bi-envelope-fill" style="font-size: 24px; color: var(--sakn-gold, #BC9355);"></i>
                        <div>
                            <h4 style="color: var(--sakn-gold, #BC9355); margin-bottom: 5px; font-weight: 700;">التواصل الإلكتروني</h4>
                            <p style="color: #e0d8c3;">management@sakn.app</p>
                        </div>
                    </div>
                    
                    <div style="display: flex; align-items: flex-start; gap: 15px;">
                        <i class="bi bi-telephone-fill" style="font-size: 24px; color: var(--sakn-gold, #BC9355);"></i>
                        <div>
                            <h4 style="color: var(--sakn-gold, #BC9355); margin-bottom: 5px; font-weight: 700;">المبيعات وخدمة العملاء</h4>
                            <p style="color: #e0d8c3;" dir="ltr">+966 92 000 0000</p>
                        </div>
                    </div>
                </div>
                <div style="flex: 1.5; min-width: 300px; padding: 60px; background: white; color: var(--text);">
                    <h3 style="font-size: 1.8rem; font-weight: 800; margin-bottom: 30px; color: var(--sakn-green, #2F4F3E);">سجل اهتمامك</h3>
                    <form action="#" method="POST">
                        <div style="display: flex; gap: 20px; margin-bottom: 25px; flex-wrap: wrap;">
                            <div style="flex: 1; min-width: 200px;">
                                <label style="display: block; font-weight: 700; margin-bottom: 8px; color: #555;">الاسم بالكامل</label>
                                <input type="text" placeholder="مثال: محمد أحمد" style="width: 100%; padding: 15px; border: 1px solid #ddd; border-radius: 5px; outline: none; background: #fcfcfc;">
                            </div>
                            <div style="flex: 1; min-width: 200px;">
                                <label style="display: block; font-weight: 700; margin-bottom: 8px; color: #555;">رقم الجوال</label>
                                <input type="text" placeholder="05X XXX XXXX" style="width: 100%; padding: 15px; border: 1px solid #ddd; border-radius: 5px; outline: none; background: #fcfcfc;">
                            </div>
                        </div>
                        <div style="margin-bottom: 25px;">
                            <label style="display: block; font-weight: 700; margin-bottom: 8px; color: #555;">المشروع المهتم به</label>
                            <select style="width: 100%; padding: 15px; border: 1px solid #ddd; border-radius: 5px; outline: none; background: #fcfcfc;">
                                <option value="">اختر المشروع...</option>
                                <option>مجمع النخبة السكني</option>
                                <option>أبراج سكن التجارية</option>
                                <option>فلل بالم هيلز</option>
                                <option>استفسار عام</option>
                            </select>
                        </div>
                        <div style="margin-bottom: 30px;">
                            <label style="display: block; font-weight: 700; margin-bottom: 8px; color: #555;">استفسارك</label>
                            <textarea rows="4" placeholder="كيف يمكن لمستشارينا مساعدتك؟" style="width: 100%; padding: 15px; border: 1px solid #ddd; border-radius: 5px; outline: none; background: #fcfcfc; font-family: inherit; resize: vertical;"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" style="padding: 15px 50px; font-size: 1.1rem; width: 100%; background: var(--sakn-gold, #BC9355); border: none; font-weight: 800;">إرسال الطلب</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
