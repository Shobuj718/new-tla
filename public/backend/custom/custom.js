function SendData(){
    var name = document.getElementById('name').value;
    var first_month_subscription_fee = document.getElementById('first_month_subscription_fee').value;
    var subscription_fee = document.getElementById('subscription_fee').value;
    var max_bids = document.getElementById('max_bids').value;
    var max_skills = document.getElementById('max_skills').value;
    var description = document.getElementById('description').value;
    
    alert(name+first_month_subscription_fee+subscription_fee+max_bids+max_skills+description);
}