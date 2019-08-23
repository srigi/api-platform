import React from 'react'

export default ({ children, yaml }) => (
  <div
    className="phpstorm"
    style={{
      backgroundColor: (yaml != null) ? 'rgb(43, 43, 43)' : 'rgb(35, 37, 37)',
      color: '#fafafa',
      width: '100vw',
      height: '100vw',
      textAlign: 'center',
      padding: '1rem',
    }}>
    {children}
  </div>
)
