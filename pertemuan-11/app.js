import express from "express"
import router from "./routes/api.js"

const app = express()

// Middleware
app.use(express.json())
app.use(express.urlencoded())

app.use("/api", router)

app.listen(3000, () => {
  console.log("Server is running on port 3000")
})
