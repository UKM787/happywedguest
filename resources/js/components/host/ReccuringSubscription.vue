<template>
    <div>
        <div id="section-8">
            <div style="margin: auto; overflow-x: auto">
                <!-- <div class="price-card-container">
                    <div>
                        <div style="background-color: green" class="plan">
                            Free plan
                        </div>
                    </div>
                    <div class="details-cont">
                        <div>/Per Month</div>
                        <div style="text-align: center">
                            <span>₹</span><span>0</span>
                        </div>
                        <div>
                            "Lorem ipsum dolor sit hjbsdc jsnznxk
                            amet,consectetur adipiscing elit, sed do eiusmod
                            tempor incididunt ut labore et dolore magna aliqua.
                            Ut enim ad minim veniam, quis nostru exercitation.
                        </div>
                        <div class="pros">
                            <img src="/assets/Vector3.svg" alt="" />
                            <span
                                >illo inventore veritatis et quasi architecto
                                beatae vitae</span
                            >
                        </div>
                        <div class="pros">
                            <img src="/assets/Vector3.svg" alt="" />
                            <span
                                >quis nostrum exercitationem ullam corporis
                                suscipit laboriosam, nisi ut aliquid ex ea
                                commodi consequatur? Quis autem vel</span
                            >
                        </div>
                        <div class="pros">
                            <img src="/assets/Vector4.svg" alt="" />
                            <span
                                >Duis aute irure dolor in reprehenderit in
                                voluptate velit esse cillum dolore eu
                            </span>
                        </div>
                        <div class="pros">
                            <img src="/assets/Vector4.svg" alt="" />
                            <span
                                >eius modi tempora incidunt ut labore et dolore
                                magnam aliquam quaerat voluptatem.</span
                            >
                        </div>
                        <div style="text-align: center; margin: 1em 0">
                            <button
                                @click="purchase($event, item)"
                                :disabled="clicked"
                                class="buy"
                            >
                                Subscribe
                            </button>
                        </div>
                    </div>
                </div> -->
                <div
                    v-for="(item, index) in priceCards"
                    :key="index"
                    class="price-card-container"
                >
                    <div>
                        <div :style="item.color" class="plan">
                            {{ item.name }}
                        </div>
                    </div>
                    <div class="details-cont">
                        <div>/Per Month</div>
                        <div style="text-align: center">
                            <span>₹</span><span>{{ item.price }}</span>
                        </div>
                        <div>
                            "Lorem ipsum dolor sit hjbsdc jsnznxk
                            amet,consectetur adipiscing elit, sed do eiusmod
                            tempor incididunt ut labore et dolore magna aliqua.
                            Ut enim ad minim veniam, quis nostru exercitation.
                        </div>
                        <div class="pros">
                            <img src="/assets/Vector3.svg" alt="" />
                            <span
                                >illo inventore veritatis et quasi architecto
                                beatae vitae</span
                            >
                        </div>
                        <div class="pros">
                            <img src="/assets/Vector3.svg" alt="" />
                            <span
                                >quis nostrum exercitationem ullam corporis
                                suscipit laboriosam, nisi ut aliquid ex ea
                                commodi consequatur? Quis autem vel</span
                            >
                        </div>
                        <div class="pros">
                            <img src="/assets/Vector4.svg" alt="" />
                            <span
                                >Duis aute irure dolor in reprehenderit in
                                voluptate velit esse cillum dolore eu
                            </span>
                        </div>
                        <div class="pros">
                            <img src="/assets/Vector4.svg" alt="" />
                            <span
                                >eius modi tempora incidunt ut labore et dolore
                                magnam aliquam quaerat voluptatem.</span
                            >
                        </div>
                        <div style="text-align: center; margin: 1em 0">
                            <button
                                @click="purchase($event, item)"
                                :disabled="clicked"
                                class="buy"
                            >
                                Subscribe
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <flashMessage :message="message"></flashMessage>
    </div>
</template>
<script>
import flashMessage from "../FlashMessage.vue";

export default {
    props: ["host", "plans"],
    components: {
        flashMessage,
    },
    data() {
        return {
            priceCards: this.plans,
            message: null,
            subID: null,
            clicked: false,
        };
    },
    methods: {
        purchase(e, item) {
            let _this = this;
            if (this.subID) {
                window.location.reload();
                return;
            }
            this.clicked = true;
            axios
                .get(route("subscribeCreateSubscribe", item.id))
                .then((res) => {
                    //console.log(response.data);
                    _this.subID = res.data.data.sub_id;
                    //console.log(_this.subID);
                    if (res.data.data.plan_id == "plan_free001") {
                        window.location.href = res.data.redirect;
                        return;
                    }
                    _this.clicked = false;

                    _this.checkout(res.data.data, res.data.redirect);
                })
                .catch((err) => {
                    console.log(err.response);
                });
        },
        checkout(data, redi) {
            console.log("inside");
            let _this = this;
            var options = {
                key: "rzp_live_wLIDlEVBFdFkFS", // Enter the Key ID generated from the Dashboard
                name: "HappyWed",
                description: "Test subsxcriptuon",
                image: "http://wedding.test/assets/login/logo.png",
                subscription_id: data.sub_id,
                handler: function (response) {
                    //console.log(response);
                    window.location.href = redi;
                    //window.location.reload();
                    //console.log(response);
                },
                prefill: {
                    name: _this.host.name,
                    email: _this.host.email,
                    contact: _this.host.mobile,
                },
                theme: {
                    color: "#3399cc",
                },
            };
            var rzp1 = new Razorpay(options);

            rzp1.on("payment.failed", function (response) {
                console.log("failure");
            });
            rzp1.open();
        },
    },
    mounted() {
        //console.log(new Razorpay());
    },
};
</script>

<style scoped>
#section-8 > div:nth-child(1)::-webkit-scrollbar {
    display: none;
}

/* Hide scrollbar for IE, Edge and Firefox */
#section-8 > div:nth-child(1) {
    -ms-overflow-style: none; /* IE and Edge */
    scrollbar-width: none; /* Firefox */
}
/* price card css start */
#section-8 {
    background: #f8f8f8;
    padding: 3em 0;
}
#section-8 > div {
    display: flex;
}
.price-card-container {
    padding-left: 19px;
    width: max-content;
    align-self: center;
    position: relative;
}
.price-card-container > div:nth-child(1) {
    padding-bottom: 20px;
    position: absolute;
}
.price-card-container > div:nth-child(1)::before {
    content: "";
    display: block;
    clip-path: polygon(0 62%, 28% 62%, 28% 100%, 28% 100%);
    width: 65px;
    height: 50px;
    background: #04262e;
    z-index: 99999;
    top: 26px;
    position: absolute;
    margin-left: -17px;
}
.plan {
    font-family: Josefin Sans;
    font-style: normal;
    font-weight: 600;
    font-size: 18.4072px;
    line-height: 18px;
    color: #ffffff;
    /* background: linear-gradient(90.27deg, #9b3154 1.62%, #6d223b 95.36%); */
    width: 111px;
    height: 37px;
    clip-path: polygon(0 0, 69% 0, 100% 100%, 0 100%);
    margin-left: -17px;
    position: absolute;
    top: 20px;
}
.details-cont {
    background: #ffffff;
    border-radius: 20px;
    padding: 1.5em 2em;
    padding-top: 5em;
    width: 266px;
}
.details-cont > div:nth-child(1) {
    font-family: Inter;
    font-style: normal;
    font-weight: normal;
    font-size: 11.1324px;
    line-height: 13px;
    color: #464646;
    text-align: right;
    padding-right: 6em;
}
.details-cont > div:nth-child(2) > span:nth-child(1) {
    font-family: Inter;
    font-style: normal;
    font-weight: bold;
    font-size: 33.6722px;
    line-height: 41px;
    color: #000000;
    padding-right: 10px;
}

.details-cont > div:nth-child(2) > span:nth-child(2) {
    font-family: Inter;
    font-style: normal;
    font-weight: bold;
    font-size: 49.4522px;
    line-height: 60px;
    color: #000000;
}
.details-cont > div:nth-child(3) {
    font-family: Josefin Sans;
    font-style: normal;
    font-weight: normal;
    font-size: 12px;
    line-height: 12px;
    color: #000000;
    margin-top: 1em;
    margin-bottom: 1.5em;
}
.pros {
    font-family: Josefin Sans;
    font-style: normal;
    font-weight: normal;
    font-size: 9px;
    line-height: 9px;
    color: #5e5e5e;
    display: flex;
    margin-bottom: 10px;
}
.pros > img {
    margin-right: 12px;
    width: 16px;
    height: 16px;
}
.pros > span {
    vertical-align: middle;
}
.buy {
    font-family: Josefin Sans;
    font-style: normal;
    font-weight: 600;
    font-size: 11.3478px;
    line-height: 11px;
    color: #ffffff;
    border: none;
    outline: 0;
    background: linear-gradient(90deg, #9b3154 0%, #6d223b 100%);
    border-radius: 20px;
    padding: 12px 28px;
}
/* price card css end */
</style>
