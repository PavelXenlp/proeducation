function formatPhoneNumber(value) {
    let digits = String(value).replace(/\D/g, "");

    if (digits.startsWith("7") || digits.startsWith("8")) {
        digits = digits.substring(1);
    }

    digits = digits.substring(0, 10);

    if (digits.length === 0) return "+7";

    let formattedValue = "+7";
    if (digits.length > 0) {
        formattedValue += ' (' + digits.substring(0, 3);
    }
    if (digits.length >= 4) {
        formattedValue += ') ' + digits.substring(3, 6);
    }
    if (digits.length >= 7) {
        formattedValue += '-' + digits.substring(6, 8);
    }
    if (digits.length >= 9) {
        formattedValue += '-' + digits.substring(8, 10);
    }
    return formattedValue;
}

function initPhoneValidation() {
    const phoneInputs = document.querySelectorAll(
        ".formattedPhone"
    );

    phoneInputs.forEach(function (input) {
        if (!(input instanceof HTMLInputElement)) return;
        if (input.dataset._phoneInit) return; // чтобы не дублировать
        input.dataset._phoneInit = "1";

        input.setAttribute("inputmode", "tel");
        if (!input.hasAttribute("maxlength") || Number(input.maxLength) < 18) {
            input.setAttribute("maxlength", "18");
        }

        function handleInput() {
            const oldValue = input.value;
            const oldCursor = input.selectionStart || 0;

            const newFormatted = formatPhoneNumber(oldValue);
            if (newFormatted === oldValue) return;

            const digitsBefore = (oldValue.slice(0, oldCursor).match(/\d/g) || []).length;
            input.value = newFormatted;

            let cnt = 0,
                newCursor = input.value.length;
            for (let i = 0; i < input.value.length; i++) {
                if (/\d/.test(input.value[i])) {
                    cnt++;
                    if (cnt === digitsBefore) {
                        newCursor = i + 1;
                        break;
                    }
                }
            }
            input.setSelectionRange(newCursor, newCursor);
        }

        function handlePaste(e) {
            e.preventDefault();
            const pastedData = (e.clipboardData || window.clipboardData).getData("text") || "";
            input.value = formatPhoneNumber(pastedData);
            input.setSelectionRange(input.value.length, input.value.length);
        }

        function handleFocus() {
            const digits = input.value.replace(/\D/g, "");
            if (digits === "" || digits === "7") {
                input.value = "+7";
                setTimeout(() => {
                    input.setSelectionRange(input.value.length, input.value.length);
                }, 0);
            }
        }

        function handleBlur() {
            input.value = formatPhoneNumber(input.value);
        }

        input.addEventListener("input", handleInput);
        input.addEventListener("paste", handlePaste);
        input.addEventListener("focus", handleFocus);
        input.addEventListener("blur", handleBlur);

        if ((input.value || "").trim() === "" || !input.value.startsWith("+7")) {
            input.value = formatPhoneNumber(input.value);
        }
    });
}

function observePhoneInputs() {
    const observer = new MutationObserver((mutations) => {
        for (const mutation of mutations) {
            for (const node of mutation.addedNodes) {
                if (!(node instanceof HTMLElement)) continue;

                if (node.matches?.("input[data-validator='phone'], .type-phone input")) {
                    initPhoneValidation();
                }

                const found = node.querySelectorAll?.(
                    "input[data-validator='phone'], .type-phone input"
                );
                if (found && found.length > 0) {
                    initPhoneValidation();
                }
            }
        }
    });

    observer.observe(document.body, {
        childList: true,
        subtree: true
    });
}

if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", () => {
        initPhoneValidation();
        observePhoneInputs();
    });
} else {
    initPhoneValidation();
    observePhoneInputs();
}