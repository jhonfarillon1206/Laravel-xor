<!DOCTYPE html>
<html lang="en">

<head>
    <title> XOR Cipher</title>

    <!--Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container mt-5">

        <div class="card shadow p-4">
            <h2 class="text-center mb-4">XOR Cipher</h2>

            {{-- Error Message --}}
            @if(session("error"))
                <div class="alert alert-danger">
                    {{ session("error") }}
                </div>
            @endif

            {{-- Encryption --}}
            <h4>Encryption</h4>

            <form method="POST" action="/xor/encrypt">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Plaintext</label>
                    <input type="text" name="plaintext" class="form-control" placeholder="Enter plaintext"
                        value="{{ session('plaintext') ?? old('plaintext') }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Key</label>
                    <input type="text" name="key" class="form-control" placeholder="Enter key"
                        value="{{ session('key') ?? old('key') }}">
                </div>

                <button class="btn btn-primary w-100">Encrypt</button>
            </form>

            {{-- Compact Conversion Table --}}
            @if(session('ciphertext_bits'))
                <h5 class="mt-3">Conversion Result:</h5>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Text</th>
                            <th>Value (as bits)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Plaintext</td>
                            <td>{{ session('plaintext') }} as bits: {{ session('plaintext_bits') }}</td>
                        </tr>
                        <tr>
                            <td>Key</td>
                            <td>{{ session('key') }} as bits: {{ session('key_bits') }}</td>
                        </tr>
                        <tr>
                            <td>Cipher</td>
                            <td>{{ session('ciphertext_bits') }}</td>
                        </tr>
                    </tbody>
                </table>
            @endif

            <hr>

            {{-- Decryption
            <h4>Decryption</h4>

            <form method="POST" action="/xor/decrypt">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Ciphertext (Binary)</label>
                    <input type="text" name="ciphertext" class="form-control" placeholder="Enter ciphertext binary"
                        value="{{ session('ciphertext_bits') ?? old('ciphertext') }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Key</label>
                    <input type="text" name="key2" class="form-control" placeholder="Enter key"
                        value="{{ session('key') ?? old('key2') }}">
                </div>

                <button class="btn btn-dark w-100">Decrypt</button>
            </form>

            @if(session("decrypted"))
            <div class="alert alert-info mt-3">
                <b>Decrypted Text:</b> {{ session("decrypted") }}
            </div>
            @endif --}}

        </div>
    </div>

    <!-- ✅ Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>