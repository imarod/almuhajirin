@props([
    'label' => 'Filter',
    'name' => '',
    'options' => [],
    'selected' => null,
])

<div class="dropdown-wrapper">
    <label>{{ $label }}</label>
    <div class="dropdown" data-name="{{ $name }}">
        <div class="dropdown-select">
            <span class="select">
                {{ $options[$selected] ?? ($selected ?? 'Pilih ' . $label) }}
            </span>
            <i class="fa fa-caret-down"></i>
        </div>
        <div class="dropdown-list">
            @foreach ($options as $key => $value)
                <div class="dropdown-list__item" data-value="{{ $key }}">
                    {{ $value }}
                </div>
            @endforeach
            <input type="hidden" name="{{ $name }}" value="{{ $selected }}">
        </div>
    </div>
</div>

<style>
    .dropdown-wrapper {
        display: inline-block;
        margin-right: 1.5rem;
    }

    .dropdown {
        width: 18rem;
        position: relative;
        font-size: 1.4rem;
    }

    .dropdown-select {
        padding: 0.8rem 1rem;
        border-radius: 4px;
        background-color: white;
        border: 1px solid #ccc;
        display: flex;
        align-items: center;
        justify-content: space-between;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .dropdown-select:hover {
        border-color: #888;
    }

    .dropdown-list {
        border-radius: 4px;
        background-color: white;
        border: 1px solid #ccc;
        position: absolute;
        top: calc(100% + 5px);
        left: 0;
        width: 100%;
        max-height: 200px;
        overflow-y: auto;
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.2s ease, visibility 0.2s ease;
        z-index: 99;
    }

    .dropdown.open .dropdown-list {
        opacity: 1;
        visibility: visible;
    }

    .dropdown-list__item {
        padding: 0.8rem 1rem;
        cursor: pointer;
        transition: background 0.2s;
    }

    .dropdown-list__item:hover {
        background-color: #f1f1f1;
    }

    .fa-caret-down {
        margin-left: 0.5rem;
    }
</style>

{{-- <script>
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll(".dropdown").forEach(dropdown => {
            const select = dropdown.querySelector(".dropdown-select");
            const list = dropdown.querySelector(".dropdown-list");
            const hidden = dropdown.querySelector("input[type=hidden]");
            const label = dropdown.querySelector(".select");

            // toggle buka/tutup dropdown saat klik
            select.addEventListener("click", (e) => {
                e.stopPropagation();
                document.querySelectorAll(".dropdown").forEach(d => {
                    if (d !== dropdown) d.classList.remove("open");
                });
                dropdown.classList.toggle("open");
            });

            // pilih item
            dropdown.querySelectorAll(".dropdown-list__item").forEach(item => {
                item.addEventListener("click", () => {
                    const val = item.dataset.value;
                    const text = item.textContent.trim();
                    hidden.value = val;
                    label.textContent = text;
                    dropdown.classList.remove("open");
                    dropdown.closest("form")?.submit();
                });
            });

            // klik di luar dropdown → tutup
            document.addEventListener("click", (e) => {
                if (!dropdown.contains(e.target)) {
                    dropdown.classList.remove("open");
                }
            });
        });
    });
</script> --}}
