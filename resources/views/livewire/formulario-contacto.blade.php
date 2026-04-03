<div>
    <h3>Contacto UPTex</h3>
    
    @if($enviado)
        <div style="color: green; margin-bottom: 10px;">¡Tu mensaje ha sido enviado correctamente!</div>
    @endif

    <form wire:submit.prevent="enviar">
        <div style="margin-bottom: 10px;">
            <label>Nombre:</label><br>
            <input wire:model.live="nombre" type="text">
            @error('nombre') <span style="color: red; display: block;">{{ $message }}</span> @enderror
        </div>

        <div style="margin-bottom: 10px;">
            <label>Email:</label><br>
            <input wire:model.live="email" type="email">
            @error('email') <span style="color: red; display: block;">{{ $message }}</span> @enderror
        </div>

        <div style="margin-bottom: 10px;">
            <label>Mensaje:</label><br>
            <textarea wire:model.live="mensaje"></textarea>
            @error('mensaje') <span style="color: red; display: block;">{{ $message }}</span> @enderror
        </div>

        <button type="submit">Enviar Mensaje</button>
    </form>
</div>