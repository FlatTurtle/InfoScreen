;//no idea why we need this here. It doesn't work without it.
//We make use of the MIT licensed later.js by Bunkat
//Check: https://github.com/bunkat/later
function cronJobs(jobs){
    $.each(jobs,function(i,job){
        scheduleJob(job);
    });
    function scheduleJob(job){
        var str = job.minutes + " " + job.hours + " " + job.day_of_month + " " + job.month + " " + job.day_of_week;
        //parse the string into a scheduler
        var scheduler = cronParser().parse(str, false);
        //execute a job every next time
        var thisjob = later(1,true); //1 second = min time between 2 occurences, true => use Local time
        thisjob.exec(scheduler, new Date(), executeJob, job);
    }
    function executeJob(job){
        try{
            eval(job.javascript);
        }catch(err){
            //do nothing
        }
    }
}