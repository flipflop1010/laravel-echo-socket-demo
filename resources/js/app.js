require('./bootstrap');


const channel=Echo.channel('message-channel')

channel.subscribed(()=>{
    console.log('subscribed channel');
})
