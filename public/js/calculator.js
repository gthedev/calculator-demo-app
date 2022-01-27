(function () {

  const $ = (selector) => document.querySelector(selector);

  const $displayValue = $("#display #value");
  const $inputsContainer = $("#inputs");

  let input = {
    numbers: [0],
    operators: [],
  };

  renderInput();

  // Add event listeners to input buttons
  const buttons = $inputsContainer.querySelectorAll("button");

  buttons.forEach(button => {
    button.addEventListener('click', function (event) {
      parseInput(event.target.dataset.action);
    });
  });


  function parseInput(action) {
    if (!action) {
      throw new Error("Invalid action: " + action);
    }

    if (!isNaN(action)) {
      // Number input, simply add to the numbers or the current number input
      let currentNumber = input.operators.length === input.numbers.length ? null : input.numbers.at(-1);

      if (currentNumber === null) {
        input.numbers.push(parseInt(action));
      } else {
        currentNumber = parseInt(currentNumber.toString() + action);
        input.numbers.splice(-1, 1, currentNumber);
      }

    } else {
      // An operator or action
      if (action === "clear") {
        resetInput();
      } else if (action === "perform") {
        return performCalculation();
      } else {
        // Operator
        if (input.operators.length === input.numbers.length) {
          // Still waiting for a number, replace the last operator
          input.operators.splice(-1, 1, action);
        } else {
          // Have a number already, add the new operator
          input.operators.push(action);
        }
      }
    }

    renderInput();
  }

  function renderInput() {
    let items = [];

    for (let i = 0; i < input.numbers.length; i++) {
      items.push(input.numbers[i]);

      if (input.operators.length > i) {
        items.push(input.operators[i]);
      }
    }

    $displayValue.innerHTML = items.join(" ");
  }

  function resetInput() {
    input = {
      numbers: [0],
      operators: [],
    };
  }

  async function performCalculation() {
    if (input.operators.length === input.numbers.length) {
      input.operators.splice(-1, 1);
    }

    renderInput();

    // @todo (if UX would be important) show loading icon and disable input

    const response = await fetch('/api/calculate', {
      method: 'POST',
      headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(input),
    });

    const result = await response.json();

    if (result.result === undefined) {
      // Could not calculate for some reason
      if (Object.hasOwnProperty.call(result, 'errors')) {
        // Errors returned, we can show first one since UX is not a big concern here
        let error = Object.values(result.errors)[0][0];
        alert(error);
      } else {
        // Unknown reason, show generic message
        alert('Could not compute, please try again');
      }
    } else {
      $displayValue.innerHTML += ' = ' + result.result;
      resetInput();
    }
  }

})();