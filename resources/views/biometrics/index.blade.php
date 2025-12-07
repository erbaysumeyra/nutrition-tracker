@extends('layouts.app')

@section('content')
    <h1>Biometrics</h1>

    <p>
        <a href="{{ route('biometrics.create') }}" class="btn btn-primary">+ New biometric entry</a>
    </p>

    @if ($biometrics->isEmpty())
        <p>No biometric entries.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Weight (kg)</th>
                    <th>BP systolic</th>
                    <th>BP diastolic</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($biometrics as $entry)
                    <tr>
                        <td>{{ $entry->measured_at }}</td>
                        <td>{{ $entry->weight_kg }}</td>
                        <td>{{ $entry->bp_systolic }}</td>
                        <td>{{ $entry->bp_diastolic }}</td>
                        <td class="actions">
                            <form action="{{ route('biometrics.destroy', $entry) }}" method="POST" onsubmit="return confirm('Delete this entry?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h2 style="margin-top: 1.5rem;">Weight over time</h2>
        <canvas id="weightChart" width="800" height="250"></canvas>

        <script>
            (function () {
                const labels = {!! $biometrics->pluck('measured_at')->map(fn($d) => (string)$d)->values()->toJson() !!};
                const values = {!! $biometrics->pluck('weight_kg')->map(fn($w) => (float)$w)->values()->toJson() !!};

                const canvas = document.getElementById('weightChart');
                if (!canvas || values.length === 0) {
                    return;
                }

                const ctx = canvas.getContext('2d');
                const width = canvas.width;
                const height = canvas.height;

                const minValue = Math.min.apply(null, values);
                const maxValue = Math.max.apply(null, values);

                const padding = 40;
                const innerWidth = width - padding * 2;
                const innerHeight = height - padding * 2;

                ctx.clearRect(0, 0, width, height);

                ctx.beginPath();
                ctx.moveTo(padding, padding);
                ctx.lineTo(padding, padding + innerHeight);
                ctx.lineTo(padding + innerWidth, padding + innerHeight);
                ctx.stroke();

                ctx.font = "12px sans-serif";

                for (let i = 0; i < labels.length; i++) {
                    const x = padding + (innerWidth * i) / Math.max(labels.length - 1, 1);
                    const y = padding + innerHeight + 15;
                    ctx.fillText(labels[i], x - 20, y);
                }

                const diff = maxValue - minValue || 1;

                ctx.beginPath();
                for (let i = 0; i < values.length; i++) {
                    const x = padding + (innerWidth * i) / Math.max(values.length - 1, 1);
                    const value = values[i];
                    const normalized = (value - minValue) / diff;
                    const y = padding + innerHeight - normalized * innerHeight;

                    if (i === 0) {
                        ctx.moveTo(x, y);
                    } else {
                        ctx.lineTo(x, y);
                    }
                }
                ctx.stroke();
            })();
        </script>
    @endif
@endsection
