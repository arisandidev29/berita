  @props([
      'error' => 'error',
      'label' => 'input',
      'class' => '',
  ])
  <fieldset class="fieldset">
      <legend class="fieldset-legend">{{ $label }}</legend>
      <textarea {{ $attributes->merge(['class' => "textarea h-24 $class"]) }} {{ $attributes }}>{{ $slot }}</textarea>
      @error($error)
          <p class="label text-red-500">{{ $message }}</p>
      @enderror
  </fieldset>
