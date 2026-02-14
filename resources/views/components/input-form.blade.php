  @props([
    "error" => "error",
    "label" => "input"
  ])
  <fieldset class="fieldset">
      <legend class="fieldset-legend">{{ $label }}</legend>
      <input class="input w-full" {{ $attributes }}/>
      @error($error)
          <p class="label text-red-500">{{ $message }}</p>
      @enderror
  </fieldset>
