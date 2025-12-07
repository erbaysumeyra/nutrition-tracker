<div class="row">
    <div>
        <label>Name</label>
        <input name="name" value="{{ old('name', optional($recipe)->name) }}" required>
        @error('name') <div style="color:red">{{ $message }}</div> @enderror
    </div>
    <div>
        <label>Calories (kcal)</label>
        <input type="number" name="calories" value="{{ old('calories', optional($recipe)->calories) }}">
    </div>
</div>

<div class="row">
    <div><label>Protein (g)</label>
        <input type="number" step="0.01" name="protein_g" value="{{ old('protein_g', optional($recipe)->protein_g) }}">
    </div>
    <div><label>Carbs (g)</label>
        <input type="number" step="0.01" name="carbs_g" value="{{ old('carbs_g', optional($recipe)->carbs_g) }}">
    </div>
    <div><label>Fat (g)</label>
        <input type="number" step="0.01" name="fat_g" value="{{ old('fat_g', optional($recipe)->fat_g) }}">
    </div>
    <div><label>Fiber (g)</label>
        <input type="number" step="0.01" name="fiber_g" value="{{ old('fiber_g', optional($recipe)->fiber_g) }}">
    </div>
</div>

<div class="row">
    <div>
        <label>CO₂e (kg per serving)</label>
        <input type="number" step="0.001" name="co2e_kg" value="{{ old('co2e_kg', optional($recipe)->co2e_kg) }}">
    </div>
</div>

<div>
    <label>Description</label>
    <textarea name="description" rows="3">{{ old('description', optional($recipe)->description) }}</textarea>
</div>
