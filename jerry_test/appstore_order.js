/*

    Front SDK Sample

    cf) Below code is provisioned by [Cafe24 Tech Support] in order to demonstrate the following
        - dynamically retrieve {mall_id} using Front SDK
        - create html DOM element (button) which will trigger the API call
        - call back-end API with the {mall_id} retrieved from Front SDK along with other parameters (order_amount, return_url, etc)

*/


//Front SDK init (replace with your app client_id)
CAFE24API.init({ client_id : 'ib7xX0F3JdltHfiu4OxrcF', version : '2021-12-01' })

//button that will initiate app store order
const appendButton = () => {

    //create button element
    let order_btn = document.createElement("button")
    order_btn.innerHTML = "AppStore Order"
    order_btn.onclick = () => {
        alert("Order button clicked")

        //env (change below values to test)
        const mall_id           = CAFE24API.MALL_ID
        const order_name        = 'appstore_order_test'
        const order_amount      = '1000'
        const return_url        = 'https://zerohacker.cafe24.com'
        const automatic_payment = 'F'
        const access_token      = 'EX97hYn7EpeKfeQszdKUvd'
        const version           = '2021-12-01'

        //you may change the below 'url path' to your server endpoint
        fetch(`https://cafe24.dev/app_store/order?mall_id=${mall_id}&order_name=${order_name}&order_amount=${order_amount}&return_url=${return_url}&automatic_payment=${automatic_payment}&access_token=${access_token}&version=${version}`)
        .then(res => res.json())
        .then(data => {
            const { confirmation_url } = data
            console.log(`confirmation_url: ${confirmation_url}`)

            //redirect to payment page
            location.href = confirmation_url
        })
    }
    
    //injecting the button in header to protrude
    $("#header").append(order_btn)

}

//appendButton() called upon page load
document.readyState === 'complete' && appendButton()