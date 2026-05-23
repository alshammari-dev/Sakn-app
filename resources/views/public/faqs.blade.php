@extends('layouts.sakn')

@section('title', 'الأسئلة الشائعة')

@section('content')
    <section class="section section-alt" style="padding: 80px 0; background: linear-gradient(135deg, var(--sakn-green, #2F4F3E) 0%, #14261C 100%); color: white; text-align: center;">
        <div class="container">
            <h1 style="font-size: 3rem; font-weight: 900; margin-bottom: 20px; color: var(--sakn-gold, #BC9355);">كيف يمكننا مساعدتك؟</h1>
            <p style="font-size: 1.2rem; color: #e0d8c3; max-width: 600px; margin: 0 auto;">إليك إجابات لأكثر الأسئلة تكراراً حول مشاريع شركة سكن للتطوير العقاري وآلية الشراء.</p>
        </div>
    </section>

    <section class="section" style="padding: 80px 0;">
        <div class="container">
            <div style="max-width: 900px; margin: 0 auto;">
                
                <!-- Category: Purchasing -->
                <div style="margin-bottom: 60px;">
                    <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 30px; border-bottom: 2px solid #eee; padding-bottom: 15px;">
                        <i class="bi bi-wallet2" style="font-size: 30px; color: var(--sakn-gold, #BC9355);"></i>
                        <h2 style="color: var(--sakn-green, #2F4F3E); margin: 0; font-weight: 800;">آلية الشراء والاستثمار</h2>
                    </div>
                    
                    <div class="faq-item" style="border-radius: 8px; border: none; box-shadow: 0 5px 15px rgba(0,0,0,0.05); margin-bottom: 20px;">
                        <span class="faq-question" style="color: var(--sakn-green, #2F4F3E); font-size: 1.1rem;"><i class="bi bi-question-circle-fill" style="color: var(--sakn-gold, #BC9355); margin-left: 10px;"></i>كيف يمكنني حجز وحدة في أحد مشاريعكم؟</span>
                        <p style="color: #666; margin-top: 10px; line-height: 1.8;">يمكنك حجز وحدتك بسهولة من خلال التواصل المباشر مع فريق المبيعات عبر الموقع أو زيارة المقر الرئيسي للشركة. يتم دفع مبلغ عربون (Deposit) لتأكيد الحجز وتثبيت السعر.</p>
                    </div>

                    <div class="faq-item" style="border-radius: 8px; border: none; box-shadow: 0 5px 15px rgba(0,0,0,0.05); margin-bottom: 20px;">
                        <span class="faq-question" style="color: var(--sakn-green, #2F4F3E); font-size: 1.1rem;"><i class="bi bi-question-circle-fill" style="color: var(--sakn-gold, #BC9355); margin-left: 10px;"></i>هل توفرون خطط سداد أو تقسيط ميسرة؟</span>
                        <p style="color: #666; margin-top: 10px; line-height: 1.8;">نعم، كشركة تطوير عقاري، نقدم لعملائنا خطط سداد مرنة تتناسب مع مراحل الإنشاء المختلفة للمشروع، بالإضافة إلى شراكات مع البنوك لتسهيل التمويل العقاري.</p>
                    </div>

                    <div class="faq-item" style="border-radius: 8px; border: none; box-shadow: 0 5px 15px rgba(0,0,0,0.05); margin-bottom: 20px;">
                        <span class="faq-question" style="color: var(--sakn-green, #2F4F3E); font-size: 1.1rem;"><i class="bi bi-question-circle-fill" style="color: var(--sakn-gold, #BC9355); margin-left: 10px;"></i>ما هو العائد الاستثماري المتوقع؟</span>
                        <p style="color: #666; margin-top: 10px; line-height: 1.8;">بفضل مواقعنا الاستراتيجية وجودة التنفيذ، تحقق مشاريعنا نمواً قوياً في القيمة الرأسمالية بالإضافة إلى عوائد تأجيرية مجزية تتجاوز متوسط السوق.</p>
                    </div>
                </div>

                <!-- Category: Projects -->
                <div>
                    <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 30px; border-bottom: 2px solid #eee; padding-bottom: 15px;">
                        <i class="bi bi-building-gear" style="font-size: 30px; color: var(--sakn-gold, #BC9355);"></i>
                        <h2 style="color: var(--sakn-green, #2F4F3E); margin: 0; font-weight: 800;">المشاريع والتسليم</h2>
                    </div>
                    
                    <div class="faq-item" style="border-radius: 8px; border: none; box-shadow: 0 5px 15px rgba(0,0,0,0.05); margin-bottom: 20px;">
                        <span class="faq-question" style="color: var(--sakn-green, #2F4F3E); font-size: 1.1rem;"><i class="bi bi-question-circle-fill" style="color: var(--sakn-gold, #BC9355); margin-left: 10px;"></i>هل يمكنني زيارة موقع المشروع قيد الإنشاء؟</span>
                        <p style="color: #666; margin-top: 10px; line-height: 1.8;">بالتأكيد. يسعدنا ترتيب جولة ميدانية آمنة لك مع أحد مهندسي المبيعات للإطلاع على سير الأعمال ومراحل البناء على أرض الواقع.</p>
                    </div>

                    <div class="faq-item" style="border-radius: 8px; border: none; box-shadow: 0 5px 15px rgba(0,0,0,0.05); margin-bottom: 20px;">
                        <span class="faq-question" style="color: var(--sakn-green, #2F4F3E); font-size: 1.1rem;"><i class="bi bi-question-circle-fill" style="color: var(--sakn-gold, #BC9355); margin-left: 10px;"></i>ما هي الضمانات المقدمة بعد الاستلام؟</span>
                        <p style="color: #666; margin-top: 10px; line-height: 1.8;">نقدم ضمانات تصل إلى 10 سنوات على الهيكل الإنشائي، وضمانات ممتدة على أعمال السباكة، الكهرباء، والتشطيبات لضمان راحة بالك.</p>
                    </div>

                    <div class="faq-item" style="border-radius: 8px; border: none; box-shadow: 0 5px 15px rgba(0,0,0,0.05); margin-bottom: 20px;">
                        <span class="faq-question" style="color: var(--sakn-green, #2F4F3E); font-size: 1.1rem;"><i class="bi bi-question-circle-fill" style="color: var(--sakn-gold, #BC9355); margin-left: 10px;"></i>هل تقدمون خدمات إدارة الأملاك؟</span>
                        <p style="color: #666; margin-top: 10px; line-height: 1.8;">نعم، نوفر خدمة متكاملة لإدارة الأملاك لعملائنا المستثمرين، تشمل التأجير، التحصيل، والصيانة الدورية للوحدة.</p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Still have questions? -->
    <section class="section section-alt" style="text-align: center; padding: 80px 0; background-color: #fcfcfc;">
        <div class="container">
            <h2 style="color: var(--sakn-green, #2F4F3E); margin-bottom: 20px; font-weight: 800;">هل لديك استفسار آخر؟</h2>
            <p style="margin-bottom: 40px; color: #666; font-size: 1.1rem;">مستشارونا العقاريون متواجدون دائماً للإجابة على جميع تساؤلاتك.</p>
            <a href="{{ route('about') }}" class="btn btn-primary" style="padding: 15px 50px; font-size: 1.1rem; font-weight: 800; background: var(--sakn-gold, #BC9355); border: none;">تواصل مع المبيعات</a>
        </div>
    </section>
@endsection
