<div class="space-y-8" dir="rtl">
	{{-- Privacy Policy --}}
	<form wire:submit.prevent="savePrivacy">
		<div class="settings-card">
			<div class="settings-card-header">
				<div>
					<h3 class="settings-card-title">سياسة الخصوصية</h3>
					<p class="settings-card-desc mt-1">تظهر في صفحة /privacy-policy وفي تذييل الموقع.</p>
				</div>
			</div>
			<div class="settings-card-body space-y-4">
				@if ($privacyMessage)
					<div class="alert-success">{{ $privacyMessage }}</div>
				@endif
				<div class="form-group">
					<label class="form-label" for="privacy_policy">نص سياسة الخصوصية</label>
					<textarea class="form-textarea min-h-[320px]" id="privacy_policy" wire:model="privacy_policy"
					 placeholder="اكتب سياسة الخصوصية هنا..."></textarea>
					<p class="form-hint">يدعم HTML البسيط مثل &lt;p&gt; &lt;strong&gt; &lt;ul&gt; &lt;li&gt;</p>
				</div>
			</div>
			<div class="settings-card-footer">
				@include("livewire.admin._partials.save-btn", ["target" => "savePrivacy", "label" => "حفظ السياسة"])
			</div>
		</div>
	</form>

	{{-- Terms of Use --}}
	<form wire:submit.prevent="saveTerms">
		<div class="settings-card">
			<div class="settings-card-header">
				<div>
					<h3 class="settings-card-title">شروط الاستخدام</h3>
					<p class="settings-card-desc mt-1">تظهر في صفحة /terms-of-use وفي تذييل الموقع.</p>
				</div>
			</div>
			<div class="settings-card-body space-y-4">
				@if ($termsMessage)
					<div class="alert-success">{{ $termsMessage }}</div>
				@endif
				<div class="form-group">
					<label class="form-label" for="terms_of_use">نص شروط الاستخدام</label>
					<textarea class="form-textarea min-h-[320px]" id="terms_of_use" wire:model="terms_of_use"
					 placeholder="اكتب شروط الاستخدام هنا..."></textarea>
				</div>
			</div>
			<div class="settings-card-footer">
				@include("livewire.admin._partials.save-btn", ["target" => "saveTerms", "label" => "حفظ الشروط"])
			</div>
		</div>
	</form>
</div>
