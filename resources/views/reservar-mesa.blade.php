@php
    $mesas = $mesas ?? \App\Models\Mesa::all();
@endphp

<!DOCTYPE html>
<html lang="es" class="dark">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Selección de Mesa - Victoria Luxury Club</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-black text-white min-h-screen p-4 sm:p-8 relative overflow-x-hidden">

  <div class="fixed inset-0 pointer-events-none -z-10 overflow-hidden">
    <div class="absolute -top-40 left-1/2 -translate-x-1/2 w-[600px] h-[600px] bg-amber-500/10 rounded-full blur-[140px]"></div>
    <div class="absolute -bottom-40 -left-20 w-[500px] h-[500px] bg-amber-600/10 rounded-full blur-[120px]"></div>
    <div class="absolute top-1/3 -right-20 w-[400px] h-[400px] bg-zinc-800/20 rounded-full blur-[100px]"></div>
  </div>

  <div class="max-w-5xl mx-auto space-y-8 relative z-10">
    <div class="text-center">
      <span class="text-xs font-semibold text-amber-400 uppercase tracking-widest">Paso 2</span>
      <h1 class="text-3xl font-black text-white mt-1">Selecciona tu Mesa en el Croquis</h1>
    </div>

    <form action="{{ route('reserva.procesar') }}" method="POST" class="space-y-8" onsubmit="return validarSeleccion()">
      @csrf

      <div class="bg-zinc-900/80 backdrop-blur-md border border-zinc-800 rounded-2xl p-6 shadow-2xl">

        <div class="flex justify-center gap-4 mb-6">
          <button type="button" id="btn-piso1" onclick="switchPiso(1)" class="px-6 py-2.5 rounded-xl font-bold text-sm bg-amber-500 text-black shadow-lg transition-all">
            Planta Baja
          </button>
          <button type="button" id="btn-piso2" onclick="switchPiso(2)" class="px-6 py-2.5 rounded-xl font-bold text-sm bg-zinc-800 text-zinc-400 hover:text-white transition-all border border-zinc-700">
            Segundo Piso
          </button>
        </div>

        <div id="vista-piso1" class="bg-zinc-950/90 border border-zinc-800 rounded-xl p-4 sm:p-8 overflow-x-auto">

          <div class="w-32 h-10 mx-auto bg-zinc-800 border border-blue-500/50 rounded flex items-center justify-center text-xs font-bold text-blue-400 mb-6">
            BARRA
          </div>
          <div class="w-full max-w-md mx-auto h-12 bg-amber-950/40 border border-amber-500/50 rounded-lg flex items-center justify-center text-sm font-black text-amber-300 mb-8">
            ESCENARIO
          </div>

          <div class="max-w-4xl mx-auto grid grid-cols-12 gap-3 items-stretch min-w-[700px]">

            <div class="col-span-4 grid grid-cols-2 gap-3">
              <div class="flex flex-col justify-between gap-2">
                <div class="flex flex-col gap-2">
                  @foreach(['L1', 'L2', 'L3'] as $codigo)
                    @php
                        $m = $mesas->firstWhere('numero', $codigo);
                        $id = $m ? $m->id : '';
                        $p = $m ? $m->precio : 0;
                    @endphp
                    <button type="button" onclick="selectMesa(event, 'Mesa {{ $codigo }}', '${{ number_format($p, 2) }}', 'VIP Exterior Izq', '{{ $id }}')" class="mesa-btn py-2 px-1.5 rounded border border-blue-500/50 bg-blue-950/30 text-white hover:border-amber-400 transition-all flex items-center justify-between">
                      <span class="font-bold text-[10px]">{{ $codigo }}</span><span class="text-[8px] text-amber-400">${{ number_format($p, 0) }}</span>
                    </button>
                  @endforeach
                </div>

                <div class="mt-4 flex flex-col gap-2">
                  @foreach(['L4', 'L5', 'L6', 'L7', 'L8'] as $codigo)
                    @php
                        $m = $mesas->firstWhere('numero', $codigo);
                        $id = $m ? $m->id : '';
                        $p = $m ? $m->precio : 0;
                    @endphp
                    <button type="button" onclick="selectMesa(event, 'Mesa {{ $codigo }}', '${{ number_format($p, 2) }}', 'VIP Exterior Izq', '{{ $id }}')" class="mesa-btn py-2 px-1.5 rounded border border-blue-500/50 bg-blue-950/30 text-white hover:border-amber-400 transition-all flex items-center justify-between">
                      <span class="font-bold text-[10px]">{{ $codigo }}</span><span class="text-[8px] text-amber-400">${{ number_format($p, 0) }}</span>
                    </button>
                  @endforeach
                </div>
              </div>

              <div class="flex flex-col justify-between py-2">
                <div class="flex flex-col gap-2">
                  @foreach(['L9', 'L10', 'L11', 'L12'] as $codigo)
                    @php
                        $m = $mesas->firstWhere('numero', $codigo);
                        $id = $m ? $m->id : '';
                        $p = $m ? $m->precio : 0;
                    @endphp
                    <button type="button" onclick="selectMesa(event, 'Mesa {{ $codigo }}', '${{ number_format($p, 2) }}', 'VIP Pista Izq', '{{ $id }}')" class="mesa-btn py-2 px-1.5 rounded border border-blue-500/50 bg-blue-950/30 text-white hover:border-amber-400 transition-all flex items-center justify-between">
                      <span class="font-bold text-[10px]">{{ $codigo }}</span><span class="text-[8px] text-amber-400">${{ number_format($p, 0) }}</span>
                    </button>
                  @endforeach
                </div>

                <div class="flex flex-col gap-2">
                  @foreach(['L13', 'L14', 'L15', 'L16'] as $codigo)
                    @php
                        $m = $mesas->firstWhere('numero', $codigo);
                        $id = $m ? $m->id : '';
                        $p = $m ? $m->precio : 0;
                    @endphp
                    <button type="button" onclick="selectMesa(event, 'Mesa {{ $codigo }}', '${{ number_format($p, 2) }}', 'VIP Pista Izq', '{{ $id }}')" class="mesa-btn py-2 px-1.5 rounded border border-blue-500/50 bg-blue-950/30 text-white hover:border-amber-400 transition-all flex items-center justify-between">
                      <span class="font-bold text-[10px]">{{ $codigo }}</span><span class="text-[8px] text-amber-400">${{ number_format($p, 0) }}</span>
                    </button>
                  @endforeach
                </div>
              </div>
            </div>

            <div class="col-span-4 border border-amber-500/40 rounded-3xl p-4 flex flex-col justify-between items-center relative min-h-[400px]">
              <div class="w-full flex-1 flex items-center justify-center my-auto">
                <div class="w-28 h-40 border border-amber-500/60 bg-amber-950/20 rounded-lg"></div>
              </div>
              <div class="w-full flex justify-between px-2">
                <div class="w-8 h-6 border border-amber-500/50 rounded"></div>
                <div class="w-8 h-6 border border-amber-500/50 rounded"></div>
              </div>
            </div>

            <div class="col-span-4 grid grid-cols-2 gap-3">
              <div class="flex flex-col justify-between py-2">
                <div class="flex flex-col gap-2 -mt-4 transform -rotate-12">
                  @foreach(['D1', 'D2'] as $codigo)
                    @php
                        $m = $mesas->firstWhere('numero', $codigo);
                        $id = $m ? $m->id : '';
                        $p = $m ? $m->precio : 0;
                    @endphp
                    <button type="button" onclick="selectMesa(event, 'Mesa {{ $codigo }}', '${{ number_format($p, 2) }}', 'VIP Superior Der', '{{ $id }}')" class="mesa-btn py-1.5 px-1.5 rounded border border-blue-500/50 bg-blue-950/30 text-white hover:border-amber-400 transition-all flex items-center justify-between">
                      <span class="font-bold text-[10px]">{{ $codigo }}</span><span class="text-[8px] text-amber-400">${{ number_format($p, 0) }}</span>
                    </button>
                  @endforeach
                </div>

                <div class="flex flex-col gap-2 mt-2">
                  @foreach(['R1', 'R2', 'R3'] as $codigo)
                    @php
                        $m = $mesas->firstWhere('numero', $codigo);
                        $id = $m ? $m->id : '';
                        $p = $m ? $m->precio : 0;
                    @endphp
                    <button type="button" onclick="selectMesa(event, 'Mesa {{ $codigo }}', '${{ number_format($p, 2) }}', 'VIP Pista Der', '{{ $id }}')" class="mesa-btn py-2 px-1.5 rounded border border-blue-500/50 bg-blue-950/30 text-white hover:border-amber-400 transition-all flex items-center justify-between">
                      <span class="font-bold text-[10px]">{{ $codigo }}</span><span class="text-[8px] text-amber-400">${{ number_format($p, 0) }}</span>
                    </button>
                  @endforeach
                </div>

                <div class="flex flex-col gap-2">
                  @foreach(['R4', 'R5', 'R6', 'R7'] as $codigo)
                    @php
                        $m = $mesas->firstWhere('numero', $codigo);
                        $id = $m ? $m->id : '';
                        $p = $m ? $m->precio : 0;
                    @endphp
                    <button type="button" onclick="selectMesa(event, 'Mesa {{ $codigo }}', '${{ number_format($p, 2) }}', 'VIP Pista Der', '{{ $id }}')" class="mesa-btn py-2 px-1.5 rounded border border-blue-500/50 bg-blue-950/30 text-white hover:border-amber-400 transition-all flex items-center justify-between">
                      <span class="font-bold text-[10px]">{{ $codigo }}</span><span class="text-[8px] text-amber-400">${{ number_format($p, 0) }}</span>
                    </button>
                  @endforeach
                </div>
              </div>

              <div class="flex flex-col justify-between py-2">
                <div class="flex flex-col gap-2 mt-12">
                  @foreach(['R8', 'R9'] as $codigo)
                    @php
                        $m = $mesas->firstWhere('numero', $codigo);
                        $id = $m ? $m->id : '';
                        $p = $m ? $m->precio : 0;
                    @endphp
                    <button type="button" onclick="selectMesa(event, 'Mesa {{ $codigo }}', '${{ number_format($p, 2) }}', 'VIP Exterior Der', '{{ $id }}')" class="mesa-btn py-2 px-1.5 rounded border border-blue-500/50 bg-blue-950/30 text-white hover:border-amber-400 transition-all flex items-center justify-between">
                      <span class="font-bold text-[10px]">{{ $codigo }}</span><span class="text-[8px] text-amber-400">${{ number_format($p, 0) }}</span>
                    </button>
                  @endforeach
                </div>

                <div class="flex flex-col gap-2">
                  @foreach(['R10', 'R11', 'R12', 'R13'] as $codigo)
                    @php
                        $m = $mesas->firstWhere('numero', $codigo);
                        $id = $m ? $m->id : '';
                        $p = $m ? $m->precio : 0;
                    @endphp
                    <button type="button" onclick="selectMesa(event, 'Mesa {{ $codigo }}', '${{ number_format($p, 2) }}', 'VIP Exterior Der', '{{ $id }}')" class="mesa-btn py-2 px-1.5 rounded border border-blue-500/50 bg-blue-950/30 text-white hover:border-amber-400 transition-all flex items-center justify-between">
                      <span class="font-bold text-[10px]">{{ $codigo }}</span><span class="text-[8px] text-amber-400">${{ number_format($p, 0) }}</span>
                    </button>
                  @endforeach
                </div>
              </div>

            </div>

          </div>
        </div>

        <div id="vista-piso2" class="bg-zinc-950/90 border border-zinc-800 rounded-xl p-4 sm:p-8 overflow-x-auto hidden">
          <h3 class="text-xs font-bold text-amber-400 uppercase text-center mb-6 tracking-widest">Plano del Segundo Piso</h3>

          <div class="max-w-4xl mx-auto flex flex-col justify-between min-w-[700px] min-h-[500px]">

            <div class="flex-1 flex gap-6">
              <div class="flex-1 border border-amber-500/40 rounded-3xl p-4 flex flex-col justify-between items-center relative min-h-[400px]">
                <div class="w-full flex-1 flex items-center justify-center my-auto">
                  <div class="w-28 h-40 border border-amber-500/60 bg-amber-950/20 rounded-lg flex items-center justify-center">
                    <span class="text-xs font-bold text-amber-400 tracking-wider uppercase">Pista</span>
                  </div>
                </div>
                <div class="w-full flex justify-between px-2">
                  <div class="w-8 h-6 border border-amber-500/50 rounded"></div>
                  <div class="w-8 h-6 border border-amber-500/50 rounded"></div>
                </div>
              </div>

              <div class="w-36 flex flex-col gap-1.5 justify-between py-1">
                @foreach(range(1, 16) as $i)
                  @php
                      $codigo = 'F' . $i;
                      $m = $mesas->firstWhere('numero', $codigo);
                      $id = $m ? $m->id : '';
                      $p = $m ? $m->precio : 0;
                  @endphp
                  <button type="button" onclick="selectMesa(event, 'Mesa {{ $codigo }}', '${{ number_format($p, 2) }}', '2do Piso - Pared', '{{ $id }}')" class="mesa-btn py-1 px-1.5 rounded border border-blue-500/50 bg-blue-950/30 text-white hover:border-amber-400 transition-all flex items-center justify-between">
                    <span class="font-bold text-[10px]">{{ $codigo }}</span>
                    <span class="text-[8px] text-amber-400">${{ number_format($p, 0) }}</span>
                  </button>
                @endforeach
              </div>
            </div>

            <div class="pt-6 border-t border-zinc-800/60 mt-4">
              <div class="grid grid-cols-4 gap-4 max-w-xl mx-auto">
                @foreach(range(1, 4) as $i)
                  @php
                      $codigo = 'A' . $i;
                      $m = $mesas->firstWhere('numero', $codigo);
                      $id = $m ? $m->id : '';
                      $p = $m ? $m->precio : 0;
                  @endphp
                  <button type="button" onclick="selectMesa(event, 'Mesa {{ $codigo }}', '${{ number_format($p, 2) }}', '2do Piso - Centro', '{{ $id }}')" class="mesa-btn py-2 px-2 rounded border border-blue-500/50 bg-blue-950/30 text-white hover:border-amber-400 transition-all flex items-center justify-between">
                    <span class="font-bold text-[10px]">{{ $codigo }}</span>
                    <span class="text-[8px] text-amber-400">${{ number_format($p, 0) }}</span>
                  </button>
                @endforeach
              </div>
            </div>

          </div>
        </div>

        <input type="hidden" name="mesa_id" id="input_mesa_id">
        <input type="hidden" name="zona" id="input_zona">

        <div id="resumen_mesa" class="mt-6 bg-amber-500/10 border border-amber-500/40 rounded-xl p-4 flex justify-between items-center hidden">
          <div>
            <span class="text-xs text-amber-400 font-bold uppercase">Mesa Seleccionada:</span>
            <h4 id="txt_mesa_nombre" class="text-lg font-black text-white">---</h4>
          </div>
          <span id="txt_mesa_precio" class="text-2xl font-black text-amber-400">$0</span>
        </div>
      </div>

      <div class="bg-zinc-900/80 backdrop-blur-md border border-zinc-800 rounded-2xl p-6 space-y-6">
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
          <div class="sm:col-span-3">
            <label class="block text-xs font-bold text-zinc-400 mb-2">NOMBRE COMPLETO</label>
            <input type="text" name="nombre" required class="w-full bg-zinc-950 border border-zinc-800 rounded-xl px-4 py-3 text-white text-sm focus:outline-none focus:border-amber-500">
          </div>
          <div>
            <label class="block text-xs font-bold text-zinc-400 mb-2">FECHA</label>
            <input type="date" name="fecha" required class="w-full bg-zinc-950 border border-zinc-800 rounded-xl px-4 py-3 text-white text-sm focus:outline-none focus:border-amber-500">
          </div>
          <div class="sm:col-span-2">
            <label class="block text-xs font-bold text-zinc-400 mb-2">PERSONAS</label>
            <select name="personas" class="w-full bg-zinc-950 border border-zinc-800 rounded-xl px-4 py-3 text-white text-sm focus:outline-none focus:border-amber-500">
              <option value="2-4">2 a 4 Personas</option>
              <option value="5-8">5 a 8 Personas</option>
            </select>
          </div>
        </div>

        <div>
          <label class="block text-xs font-bold text-zinc-400 mb-2">MÉTODO DE PAGO</label>
          <div class="grid grid-cols-2 gap-4">
            <label class="border border-zinc-800 bg-zinc-950 rounded-xl p-3 cursor-pointer flex items-center gap-2">
              <input type="radio" name="metodo_pago" value="tarjeta" checked class="accent-amber-500">
              <span class="text-xs font-medium">Tarjeta</span>
            </label>
            <label class="border border-zinc-800 bg-zinc-950 rounded-xl p-3 cursor-pointer flex items-center gap-2">
              <input type="radio" name="metodo_pago" value="paypal" class="accent-amber-500">
              <span class="text-xs font-medium">PayPal</span>
            </label>
          </div>
        </div>

        <button type="submit" class="w-full bg-amber-500 hover:bg-amber-400 text-black font-extrabold py-4 rounded-xl transition-all shadow-lg shadow-amber-500/10">
          Pagar y Finalizar Reserva
        </button>
      </div>

    </form>
  </div>

  <script>
    function switchPiso(piso) {
      const v1 = document.getElementById('vista-piso1');
      const v2 = document.getElementById('vista-piso2');
      const b1 = document.getElementById('btn-piso1');
      const b2 = document.getElementById('btn-piso2');

      if (piso === 1) {
        v1.classList.remove('hidden');
        v2.classList.add('hidden');
        b1.className = "px-6 py-2.5 rounded-xl font-bold text-sm bg-amber-500 text-black shadow-lg transition-all";
        b2.className = "px-6 py-2.5 rounded-xl font-bold text-sm bg-zinc-800 text-zinc-400 hover:text-white transition-all border border-zinc-700";
      } else {
        v2.classList.remove('hidden');
        v1.classList.add('hidden');
        b2.className = "px-6 py-2.5 rounded-xl font-bold text-sm bg-amber-500 text-black shadow-lg transition-all";
        b1.className = "px-6 py-2.5 rounded-xl font-bold text-sm bg-zinc-800 text-zinc-400 hover:text-white transition-all border border-zinc-700";
      }
    }

    function selectMesa(e, nombre, precio, zona, idMesa = '') {
      document.querySelectorAll('.mesa-btn').forEach(btn => {
        btn.classList.remove('bg-amber-500', 'text-black');
        btn.classList.add('bg-zinc-900');
      });

      const btnActivo = e.currentTarget;
      btnActivo.classList.remove('bg-zinc-900');
      btnActivo.classList.add('bg-amber-500', 'text-black');

      document.getElementById('input_mesa_id').value = idMesa || nombre;
      document.getElementById('input_zona').value = zona;

      document.getElementById('txt_mesa_nombre').innerText = nombre;
      document.getElementById('txt_mesa_precio').innerText = precio;

      document.getElementById('resumen_mesa').classList.remove('hidden');
    }

    function validarSeleccion() {
      const mesa = document.getElementById('input_mesa_id').value;
      if (!mesa) {
        alert('Por favor selecciona una mesa en el mapa antes de continuar.');
        return false;
      }
      return true;
    }
  </script>

</body>
</html>