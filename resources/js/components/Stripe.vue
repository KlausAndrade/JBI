<template>
  <form id="payment-form" @click.prevent="">
    <div class="form-row">
      <label for="card-element">
        Credit or debit card
      </label>

      <div id="card-element">
        <!-- A Stripe Element will be inserted here. -->
      </div>

      <!-- Used to display form errors. -->
      <div id="card-errors" role="alert" />
    </div>

    <button v-if="client" id="card-button" class="btn btn-primary" :data-secret="client.client_secret">
      Payment method
    </button>
    <!--    <button>Submit Payment</button>-->
    <button @click.prevent="generateInvoice">
      Buys
    </button>
  </form>
</template>

<script>

import axios from 'axios'

let stripe = Stripe(process.env.MIX_STRIPE)
let elements = stripe.elements()
//
const cardHolderName = document.getElementById('card-holder-name')
const cardButton = document.getElementById('card-button')
// const clientSecret = cardButton.dataset.secret
// console.log(clientSecret)

export default {

    data () {
        return {
            client: null,
            paymentMethod: null
        }
    },
    beforeMount () {
        axios.get(`/api/checkout/intent-payment-method`)
            .then(({ data }) => {
                this.client = data
            })
    },

    mounted: function () {
        let style = {
            base: {
                color: '#32325d',
                fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                fontSmoothing: 'antialiased',
                fontSize: '16px',
                '::placeholder': {
                    color: '#aab7c4'
                }
            },
            invalid: {
                color: '#fa755a',
                iconColor: '#fa755a'
            }
        }

        // Create an instance of the card Element.
        let card = elements.create('card', { style: style })

        // Add an instance of the card Element into the `card-element` <div>.
        card.mount('#card-element')

        setTimeout(function () {
            if (cardButton) {
                cardButton.addEventListener('click', async (e) => {
                    const { paymentMethod, error } = await stripe.createPaymentMethod(
                        'card', card, {
                            billing_details: { name: cardHolderName.value }
                        }
                    )

                    if (error) {
                        alert(error)
                    } else {
                        this.paymentMethod = paymentMethod
                    }
                })
            }
        }, 3000)

        // Handle real-time validation errors from the card Element.
        card.addEventListener('change', function (event) {
            var displayError = document.getElementById('card-errors')
            if (event.error) {
                displayError.textContent = event.error.message
            } else {
                displayError.textContent = ''
            }
        })

        // Handle form submission.
        var form = document.getElementById('payment-form')
        form.addEventListener('submit', function (event) {
            event.preventDefault()

            stripe.createToken(card).then(function (result) {
                if (result.error) {
                    // Inform the user if there was an error.
                    var errorElement = document.getElementById('card-errors')
                    errorElement.textContent = result.error.message
                } else {
                    // Send the token to your server.
                    stripeTokenHandler(result.token)
                }
            })
        })

        // Submit the form with the token ID.
        function stripeTokenHandler (token) {
            // Insert the token ID into the form so it gets submitted to the server
            var form = document.getElementById('payment-form')
            var hiddenInput = document.createElement('input')
            hiddenInput.setAttribute('type', 'hidden')
            hiddenInput.setAttribute('name', 'stripeToken')
            hiddenInput.setAttribute('value', token.id)
            form.appendChild(hiddenInput)

            // Submit the form
            form.submit()
        }
    },

    methods: {

        generateInvoice () {
            axios.get(`/api/checkout/invoice`)
                .then(({ data }) => {
                    console.log(data)
                })
        }
    }
}
</script>

<style scoped>
  /**
   * The CSS shown here will not be introduced in the Quickstart guide, but shows
   * how you can use CSS to style your Element's container.
   */
  .StripeElement {
    box-sizing: border-box;

    height: 40px;

    padding: 10px 12px;

    border: 1px solid transparent;
    border-radius: 4px;
    background-color: white;

    box-shadow: 0 1px 3px 0 #e6ebf1;
    -webkit-transition: box-shadow 150ms ease;
    transition: box-shadow 150ms ease;
  }

  .StripeElement--focus {
    box-shadow: 0 1px 3px 0 #cfd7df;
  }

  .StripeElement--invalid {
    border-color: #fa755a;
  }

  .StripeElement--webkit-autofill {
    background-color: #fefde5 !important;
  }
</style>
