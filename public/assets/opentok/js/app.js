var ringerAudio = new Audio(ringTonePath);
ringerAudio.addEventListener('ended', function() {
	    this.currentTime = 0;
	    this.play();
	}, false);
	
    

/* global otCore */
const options = {
  credentials: opentokCredentials,
   // A container can either be a query selector or an HTMLElement
  streamContainers: function streamContainers(pubSub, type, data) {
    return {
      publisher: {
        camera: '#cameraPublisherContainer',
      },
      subscriber: {
        camera: '#cameraSubscriberContainer',
      },
    }[pubSub][type];
  },
  controlsContainer: '#controls',
  packages: [],
  communication: {
    callProperites: null, // Using default
  }
};

/** Application Logic */
const OpentokApp = () => {
  var state = {
		connected: false,
		active: false,
		publishers: null,
		subscribers: null,
		meta: null,
		localAudioEnabled: true,
		localVideoEnabled: localVideoEnabled,
	};
  /**
   * Update the size and position of video containers based on the number of
   * publishers and subscribers specified in the meta property returned by otCore.
   */
  const updateVideoContainers = () => {
    const { meta } = state;
    const activeCameraSubscribers = meta ? meta.subscriber.camera : 0;

    const videoContainerClass = `App-video-container ${''}`;
    document.getElementById('appVideoContainer').setAttribute('class', videoContainerClass);

    const cameraPublisherClass =
      `video-container ${!!activeCameraSubscribers? 'small' : ''} ${!!activeCameraSubscribers? 'small' : ''}`;
    
    document.getElementById('cameraPublisherContainer').setAttribute('class', cameraPublisherClass);
    
    // if(!meta.publisher){
    //     document.getElementById('cameraPublisherContainer').setAttribute('class', 'hidden');
    // }

    const cameraSubscriberClass =
      `video-container ${!activeCameraSubscribers ? 'hidden' : ''} active-${activeCameraSubscribers}`;
    document.getElementById('cameraSubscriberContainer').setAttribute('class', cameraSubscriberClass);
    
    console.log('updateVideoContainers');
    
  };


  /**
   * Update the UI
   * @param {String} update - 'connected', 'active', or 'meta'
   */
  const updateUI = (update) => {
    const { connected, active } = state;

    switch (update) {
      case 'connected':
        if (connected) {
          document.getElementById('connecting-mask').classList.add('hidden');
          document.getElementById('start-mask').classList.remove('hidden');
          console.log('connected');
        }
        break;
      case 'active':
        if (active) {
          document.getElementById('cameraPublisherContainer').classList.remove('hidden');
          document.getElementById('start-mask').classList.add('hidden');
          document.getElementById('controls').classList.remove('hidden');
          console.log('active');
        }
        else {
          document.getElementById('start-mask').classList.remove('hidden');
          document.getElementById('controls').classList.add('hidden');
          document.getElementById('cameraPublisherContainer').classList.add('hidden');
          document.getElementById('toggleLocalVideo').classList.remove('muted');
          document.getElementById('toggleLocalAudio').classList.remove('muted');
          console.log('active else');
        }
        break;
      case 'meta':
        updateVideoContainers();
        if(!active) document.getElementById('cameraPublisherContainer').classList.add('hidden');
         console.log('meta');
        break;
      default:
        console.log('nothing to do, nowhere to go');
    }
  };

  /**
   * Update the state and UI
   */
  const updateState = (updates) => {
    Object.assign(state, updates);
    Object.keys(updates).forEach(update => updateUI(update));
    console.log("updateState");
  };

  /**
   * Start publishing video/audio and subscribe to streams
   */
  const startCall = () => {
    
    otCore.startCall()
      .then(({ publishers, subscribers, meta }) => {
        
        if(localVideoEnabled) turnOnVideo();
        else turnOffVideo();

        ringerAudio.pause();
        updateState({ publishers, subscribers, meta, active: true});
  
      }).catch(error => console.log(error));
      
      console.log("startCall");
      
    };
  
  const startVoiceCall = () => {
      localVideoEnabled = false;
      startCall();
      console.log('startVoiceCall');
  };
  
  
  const startVideoCall = () => {
      localVideoEnabled = true;
      startCall();
      console.log('startVideoCall');
  };

  /**
   * Toggle publishing local audio
   */
  const toggleLocalAudio = () => {
    const enabled = state.localAudioEnabled;
    otCore.toggleLocalAudio(!enabled);
    updateState({ localAudioEnabled: !enabled });
    const action = enabled ? 'add' : 'remove';
    document.getElementById('toggleLocalAudio').classList[action]('muted');
    console.log('toggleLocalAudio');
  };

  /**
   * Toggle publishing local video
   */
  const toggleLocalVideo = () => {
    const enabled = state.localVideoEnabled;
    localVideEnabled = !enabled;
    otCore.toggleLocalVideo(!enabled);
    updateState({ localVideoEnabled: !enabled });
    const action = enabled ? 'add' : 'remove';
    document.getElementById('toggleLocalVideo').classList[action]('muted');
    console.log('toggleLocalVideo');
  };

    /**
     *  turn off video
     */

    const turnOffVideo = () => {
        const enabled = true;
        otCore.toggleLocalVideo(!enabled);
        updateState({ localVideoEnabled: !enabled });
        const action = enabled ? 'add' : 'remove';
        document.getElementById('toggleLocalVideo').classList[action]('muted');
        console.log('turnOffVideo');
    }
    
    /**
     *  turn On video
     */

    const turnOnVideo = () => {
        const enabled = false;
        otCore.toggleLocalVideo(!enabled);
        updateState({ localVideoEnabled: !enabled });
        const action = enabled ? 'add' : 'remove';
        document.getElementById('toggleLocalVideo').classList[action]('muted');
        console.log('turnOnVideo');
    }

  /**
   * Toggle end call
   */
  const toggleEndCall = () => {
    updateState({ active: false });
    otCore.endCall();
    jQuery('#start-mask').html('<div class="message button clickable" id="start">Click to Start Call</div>');
    console.log("Call ended.");
    setTimeout(function(){
        document.getElementById('cameraPublisherContainer').classList.add('hidden');    
    }, 1000);
    
    console.log('toggleEndCall');
    
  };

  /**
   * Subscribe to otCore and UI events
   */
  const createEventListeners = () => {
    const events = [
      'subscribeToCamera',
      'unsubscribeFromCamera',
    ];
    events.forEach(event => otCore.on(event, ({ publishers, subscribers, meta }) => {
      updateState({ publishers, subscribers, meta });
    }));

    document.getElementById('start').addEventListener('click', startCall);
    document.getElementById('toggleLocalAudio').addEventListener('click', toggleLocalAudio);
    document.getElementById('toggleLocalVideo').addEventListener('click', toggleLocalVideo);
    document.getElementById('toggleEndCall').addEventListener('click', toggleEndCall);
    document.getElementById('opentokCallerClose').addEventListener('click', toggleEndCall);
    document.addEventListener('click',function(e){
        
        if(e.target && e.target.id== 'start-audio'){
            startVoiceCall();
        }
        
        
        if(e.target && e.target.id== 'start-video'){
            startVideoCall();
        }
        
    });
    
    console.log('createEventListeners');

  };

  /**
   * Initialize otCore, connect to the session, and listen to events
   */
  const init = () => {
     
    otCore.init(options);
    
    otCore.connect().then(() => updateState({ connected: true }));
    
    createEventListeners();
    
    /**
     * Dispatched when a new client (including your own) has connected to the session, 
     * and for every client in the session when you first connect. 
     * (The Session object also dispatches a sessionConnected event when your local client connects.)
     */
    
    otCore.on('connectionCreated', function () {
      ringerAudio.pause();
      console.log("connection created");
    });
    
    /**
     * A client, other than your own, has disconnected from the session.
     */
     
    otCore.on('connectionDestroyed', function(){
        console.log("connection destroyed");
    });
    

    /**
     * A new stream, published by another client, has been created on this session. 
     * For streams published by your own client, the Publisher object dispatches a streamCreated event. 
     */
     
    otCore.on('streamCreated', function (event) {

      if(!(jQuery("#opentokCallerModal").is(':visible'))){
        jQuery("#opentokCallerModal").modal('show');
      }
      
      jQuery('#start-mask').html("<span>"+opentokCallerName+" is Calling...</span> <div class='message button clickable' id='start-audio'><i class='fa fa-phone'></i></div><div class='message button clickable' id='start-video'><i class='fa fa-video-camera'></i></div>");
      
      if(!(jQuery("#start-mask").hasClass("hidden"))){
        ringerAudio.play();
      }
      
      if(localVideoEnabled && event.stream.hasVideo){
          localVideEnabled = true;
          turnOnVideo();
      } else {
          localVideEnabled = false;
          turnOffVideo();
      }
      
      console.log("stream created");
      
    });
    
    /**
     * A stream from another client has stopped publishing to the session.
     * The default behavior is that all Subscriber objects that are subscribed to the stream are unsubscribed and removed from the HTML DOM.
     * Each Subscriber object dispatches a destroyed event when the element is removed from the HTML DOM. 
     * If you call the preventDefault() method in the event listener for the streamDestroyed event, 
     * the default behavior is prevented and you can clean up a Subscriber object for the stream by calling its destroy() method.
     */
    
    otCore.on('streamDestroyed', function(event){
        toggleEndCall();
        ringerAudio.pause();
        console.log("stream destroyed");
    });
    
    otCore.on('sessionConnected', function(event){
        console.log("sessionConnected");
    });
    
  };

  init();
};
