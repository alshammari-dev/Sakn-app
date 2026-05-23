@extends('layouts.sakn')

@section('title', 'فريق المبيعات')

@section('content')
    <section class="section section-alt" style="padding: 60px 0; border-bottom: 1px solid var(--border);">
        <div class="container" style="text-align: center;">
            <p style="color: var(--sakn-gold, #BC9355); font-weight: 700; font-size: 1.1rem; margin-bottom: 10px;">نخبة مستشاري العقارات</p>
            <h1 style="font-size: 48px; color: var(--sakn-green, #2F4F3E); font-weight: 900; margin-bottom: 20px;">فريق مبيعات سكن</h1>
            <p style="color: #555; font-size: 1.1rem; max-width: 700px; margin: 0 auto; line-height: 1.8;">يضم فريقنا مجموعة من أفضل المستشارين العقاريين المتخصصين في المشاريع الفاخرة، جاهزين لمساعدتك في اختيار الوحدة المثالية التي تناسب تطلعاتك الاستثمارية أو السكنية.</p>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="card-grid" style="grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));">
                @forelse($agents as $agent)
                    <div class="card agent-card" style="border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.05); transition: transform 0.3s; border-radius: 8px;">
                        <div class="agent-avatar" style="border-color: var(--sakn-gold, #BC9355); border-width: 3px; border-radius: 50%; padding: 5px; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($agent->name) }}&background=2F4F3E&color=BC9355&size=120&bold=true" alt="{{ $agent->name }}" style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">
                        </div>
                        <h3 class="agent-name" style="color: var(--sakn-green, #2F4F3E); margin-bottom: 5px;">{{ $agent->name }}</h3>
                        <p class="agent-role" style="color: var(--sakn-gold, #BC9355); font-weight: 700;">مستشار مبيعات أول</p>
                        <p style="font-size: 14px; color: var(--text-muted); margin-bottom: 25px; border-top: 1px solid #f1f1f1; padding-top: 15px;">
                            <i class="bi bi-building" style="color: var(--sakn-gold, #BC9355);"></i> مشرف على {{ $agent->properties_count }} وحدة ضمن مشاريعنا
                        </p>
                        <a href="mailto:{{ $agent->email ?? 'info@sakn.app' }}" class="btn btn-outline" style="width: 100%; border-color: var(--sakn-green, #2F4F3E); color: var(--sakn-green, #2F4F3E);">تواصل مع المستشار</a>
                    </div>
                @empty
                    <div style="grid-column: 1 / -1; text-align: center; padding: 80px 20px; background: white; border-radius: 8px; box-shadow: 0 10px 30px rgba(0,0,0,0.05);">
                        <i class="bi bi-people" style="font-size: 60px; color: #ddd; margin-bottom: 20px; display: block;"></i>
                        <h3 style="color: var(--sakn-green, #2F4F3E); margin-bottom: 15px;">جاري تحديث قائمة الفريق</h3>
                        <p style="color: #777;">فريق المبيعات لدينا متاح دائماً لخدمتك. يرجى التواصل مع الإدارة العامة مباشرة.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Support Section Instead of 'Join as Agent' -->
    <section class="section" style="background: linear-gradient(135deg, var(--sakn-green, #2F4F3E) 0%, #14261C 100%); color: var(--white); text-align: center; padding: 100px 0;">
        <div class="container">
            <h2 style="font-size: 36px; margin-bottom: 20px; font-weight: 800; color: #fff;">هل تحتاج إلى مساعدة في اختيار وحدتك؟</h2>
            <p style="max-width: 700px; margin: 0 auto 40px; font-size: 1.1rem; line-height: 1.8; color: #e0d8c3;">نحن هنا لتقديم استشارات عقارية مخصصة تناسب احتياجاتك وتطلعاتك. تواصل مع إدارة مبيعات شركة سكن للتطوير العقاري وسيقوم أحد مستشارينا بالرد عليك في أقرب وقت.</p>
            <div style="display: flex; gap: 20px; justify-content: center; flex-wrap: wrap;">
                <a href="#" class="btn btn-accent" style="padding: 15px 40px; font-size: 1.1rem; background: var(--sakn-gold, #BC9355); border: none;">احجز موعد استشارة</a>
                <a href="tel:+966500000000" class="btn btn-outline" style="padding: 15px 40px; font-size: 1.1rem; border-color: var(--sakn-gold, #BC9355); color: var(--sakn-gold, #BC9355);">اتصل بنا الآن</a>
            </div>
        </div>
    </section>
@endsection
