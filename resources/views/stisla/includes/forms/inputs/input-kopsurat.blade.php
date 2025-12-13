@include('stisla.includes.forms.inputs.input', [
    'id' => 'cop_surat',
    'type' => 'file',
    'accept' => 'image/*',
    'label' => __('Logo UPI'),
    'required' => $required ?? true,
    'icon' => 'fas fa-file-image',
])
