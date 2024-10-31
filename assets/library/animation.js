window.addEventListener( 'load', () => {
    const observer = new IntersectionObserver( ( entries ) => {
        entries.forEach( ( entry ) => {
            const { opAnimation } = entry.target.dataset;
            if ( entry.isIntersecting && opAnimation !== 'undefined' ) {
                if ( ! opAnimation ) {
                    return;
                }
                const sanitizedOpAnimation = opAnimation.split( ' ' );
                entry.target.classList.add( ...sanitizedOpAnimation );
                // removed data set after added classlist
                // entry.target.removeAttribute( 'data-op-animation' );
            }
        } );
    }, {
        threshold: 0.3,
    } );

    const animatedEl = document.querySelectorAll( '.op_has_animation' );

    animatedEl.forEach( ( el ) => {
        observer.observe( el );
    } );
} );
